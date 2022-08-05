<?php

namespace App\Services;

use App\Repositories\OpportunityObstacles\OpportunityObstacleRepositoryInterface;
use App\Repositories\Players\PlayerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class OpportunityObstacleService
{
    private OpportunityObstacleRepositoryInterface $opsRepo;
    private PlayerRepositoryInterface $players;

    public function __construct(OpportunityObstacleRepositoryInterface $opsRepo,
        PlayerRepositoryInterface $players)
    {
        $this->opsRepo = $opsRepo;
        $this->players = $players;
    }

    public function getPlayers($id)
    {
        return $this->players->getWhereMany(["project_id" => $id]);
    }

    public function insert($data, $id)
    {
        try{
            DB::beginTransaction();
            $this->opsRepo->create([
                "opportunity" => $data->opportunity,
                "obstacle" => $data->obstacle,
                "comments" => $data->comments,
                "is_more_research_needed" => $data->need_more_investivigation,
                "player_id" => $data->player_id,
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

    public function update($data, $id)
    {
        try{
            DB::beginTransaction();
            $this->opsRepo->update($id, [
                "opportunity" => $data->opportunity,
                "obstacle" => $data->obstacle,
                "comments" => $data->comments,
                "is_more_research_needed" => $data->need_more_investivigation,
                "player_id" => $data->player_id
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
            $this->opsRepo->delete($id);
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
        return $this->opsRepo->getEloquentInstance();
    }
}