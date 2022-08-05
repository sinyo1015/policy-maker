<?php

namespace App\Services;

use App\Constants\PositionScale;
use App\Repositories\LevelNames\LevelNameRepositoryInterface;
use App\Repositories\Players\PlayerRepositoryInterface;
use App\Repositories\Sectors\SectorRepositoryInterface;
use Illuminate\Support\Facades\DB;
use stdClass;
use Throwable;

class PlayerService
{
    private SectorRepositoryInterface $sector;
    private LevelNameRepositoryInterface $level;
    private PlayerRepositoryInterface $player;
    private ProjectPropertyService $project;

    public function __construct(SectorRepositoryInterface $sector,
        LevelNameRepositoryInterface $level,
        PlayerRepositoryInterface $player,
        ProjectPropertyService $project)
    {
        $this->sector = $sector;
        $this->level = $level;
        $this->player = $player;
        $this->project = $project;
    }

    public function getSectorAndLevels($id)
    {
        $sectors = $this->sector->getWhereMany(["project_id" => $id]);
        $levels = $this->level->getWhereMany(["project_id" => $id]);
        
        return [
            "sectors" => $sectors,
            "levels" => $levels
        ];
    }

    public function getDetails($id)
    {
        return $this->player->detail($id);
    }

    public function insertEntry($data, $id)
    {
        try{
            DB::beginTransaction();
            $this->player->create([
                "name" => $data->name,
                "details" => $data->details,
                "sector_id" => $data->sector, 
                "level_id" => $data->level,
                "position" => $data->position_scale,
                "power" => $data->power_scale,
                "project_id" => $id
            ]);
            DB::commit();

            return true;
        }
        catch(Throwable $e){
            DB::rollBack();

            return false;
        }
    }

    public function editEntry($data, $id)
    {
        try{
            DB::beginTransaction();
            $this->player->update($id, [
                "name" => $data->name,
                "details" => $data->details,
                "sector_id" => $data->sector, 
                "level_id" => $data->level,
                "position" => $data->position_scale,
                "power" => $data->power_scale
            ]);
            DB::commit();

            return true;
        }
        catch(Throwable $e){
            DB::rollBack();

            return false;
        }
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            $this->player->delete($id);
            DB::commit();

            return true;
        }
        catch(Throwable $e){
            DB::rollBack();

            return false;
        }
    }

    public function getPlayersGroupped($id)
    {
        $scales = $this->project->getScales($id);
        $players = $this->player->getWhereMany(["project_id" => $id]);

        $group = [
            PositionScale::HIGH_SUPPORT => [],
            PositionScale::MEDIUM_SUPPORT => [],
            PositionScale::LOW_SUPPORT => [],
            PositionScale::NON_MOBILIZED => [],
            PositionScale::LOW_OPOSITION => [],
            PositionScale::MEDIUM_OPOSITION => [],
            PositionScale::HIGH_OPOSITION => []
        ];

        foreach($players as $player){
            if($player->position <= $scales?->ps_dh){
                array_push($group[PositionScale::HIGH_OPOSITION], $player);
                continue;
            }
            if($player->position <= $scales?->ps_dml && $player->position <= $scales?->ps_dmh){
                array_push($group[PositionScale::MEDIUM_OPOSITION], $player);
                continue;
            }
            if($player->position <= $scales?->ps_dll && $player->position <= $scales?->ps_dlh){
                array_push($group[PositionScale::LOW_OPOSITION], $player);
                continue;
            }
            if($player->position <= $scales?->ps_nl && $player->position >= $scales?->ps_nh){
                array_push($group[PositionScale::NON_MOBILIZED], $player);
                continue;
            }
            if($player->position >= $scales?->ps_sll && $player->position <= $scales?->ps_slh){
                array_push($group[PositionScale::LOW_SUPPORT], $player);
                continue;
            }
            if($player->position >= $scales?->ps_sml && $player->position <= $scales?->ps_smh){
                array_push($group[PositionScale::MEDIUM_SUPPORT], $player);
                continue;
            }
            if($player->position >= $scales?->ps_sh){
                array_push($group[PositionScale::HIGH_SUPPORT], $player);
                continue;
            }
        }

        return $group;
    }

    public function getFeasibility($id)
    {
        $scales = $this->project->getScales($id);

        $std = new stdClass;
        $std->support = DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position > ? AND project_id = ?", [$scales?->ps_nh, $id]);
        $std->neutral = DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position <= ? AND position >= ? AND project_id = ?", [$scales?->ps_nl, $scales?->ps_nh, $id]);
        $std->oposition = DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position >= ? AND project_id = ?", [$scales?->ps_dlh, $id]);

        return $std;
    }

    public function getGroupedCoalitions($id)
    {
        $scales = $this->project->getScales($id);

        $std = new stdClass;
        $std->support = $this->player->getWhereMany([["position", ">", $scales?->ps_sll], ["project_id", "=", $id]]); //DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position > ?", [$scales?->ps_nh]);
        $std->neutral = $this->player->getWhereMany([["position", "<=", $scales?->ps_nl], ["position", ">=", $scales?->ps_nh], ["project_id", "=", $id]]); //DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position <= ? AND position >= ?", [$scales?->ps_nl, $scales?->ps_nh]);
        $std->oposition = $this->player->getWhereMany([["position", "<=", $scales?->ps_dlh], ["project_id", "=", $id]]); //DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position >= ?", [$scales?->ps_dlh]);
    
        return $std;
    }

    public function updatePlayerPos($data, $id)
    {
        try{
            DB::beginTransaction();
            $this->player->update($data->player_id, [
                "pos_x" => $data->pos_x,
                "pos_y" => $data->pos_y
            ]);
            DB::commit();

            return true;
        }
        catch(Throwable $e){

            DB::rollBack();

            return false;
        }
    }

    public function getEloquentInstance()
    {
        return $this->player->getEloquentInstance();
    }
}