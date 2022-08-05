<?php

namespace App\Services;

use App\Repositories\Consequences\ConsequenceRepositoryInterface;
use App\Repositories\Players\PlayerRepositoryInterface;
use App\Repositories\PolicyConsequences\PolicyConsequenceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class ConsequenceService
{
    private ConsequenceRepositoryInterface $consequences;
    private PlayerRepositoryInterface $players;
    private PolicyConsequenceRepositoryInterface $policyConsequences;

    public function __construct(ConsequenceRepositoryInterface $consequence, 
        PlayerRepositoryInterface $player,
        PolicyConsequenceRepositoryInterface $policyConsequences)
    {
        $this->consequences = $consequence;
        $this->players = $player;
        $this->policyConsequences = $policyConsequences;
    }

    public function getPlayers($id)
    {
        return $this->players->getWhereMany(["project_id" => $id]);
    }

    public function getConsequences($id)
    {
        return $this->consequences->getWhereMany(["project_id" => $id]);
    }

    public function insert($data, $id)
    {
        try{
            DB::beginTransaction();
            $this->policyConsequences->create([
                "description" => $data->description,
                "size_of_consequence" => $data->impact,
                "timing_of_consequence" => $data->timing,
                "consequence_id" => $data->type,
                "importance" => $data->importance,
                "player_id" => $data->target,
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

    public function update($id, $data)
    {
        try{
            DB::beginTransaction();
            $this->policyConsequences->update($id, [
                "description" => $data->description,
                "size_of_consequence" => $data->impact,
                "timing_of_consequence" => $data->timing,
                "consequence_id" => $data->type,
                "importance" => $data->importance,
                "player_id" => $data->target
            ]);
            DB::commit();

            return true;
        }
        catch(Throwable $e){
            DB::rollBack();

            return false;
        }
    }

    public function getConsequencesDetail($id)
    {
        return $this->policyConsequences->getEloquentInstance()->with(["player", "consequence"])->find($id);
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            $this->policyConsequences->delete($id);
            DB::commit();

            return true;
        }
        catch(Throwable $e){
            DB::rollBack();

            return false;
        }
    }

    public function getConsequencesEloquentInstance()
    {
        return $this->policyConsequences->getEloquentInstance();
    }


}