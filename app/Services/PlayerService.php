<?php

namespace App\Services;

use App\Repositories\LevelNames\LevelNameRepositoryInterface;
use App\Repositories\Players\PlayerRepositoryInterface;
use App\Repositories\Sectors\SectorRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class PlayerService
{
    private SectorRepositoryInterface $sector;
    private LevelNameRepositoryInterface $level;
    private PlayerRepositoryInterface $player;

    public function __construct(SectorRepositoryInterface $sector,
        LevelNameRepositoryInterface $level,
        PlayerRepositoryInterface $player)
    {
        $this->sector = $sector;
        $this->level = $level;
        $this->player = $player;
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

    public function getEloquentInstance()
    {
        return $this->player->getEloquentInstance();
    }
}