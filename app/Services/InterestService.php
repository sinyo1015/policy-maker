<?php

namespace App\Services;

use App\Repositories\Interests\InterestRepositoryInterface;
use App\Repositories\Players\PlayerRepositoryInterface;
use App\Repositories\PolicyInterests\PolicyInterestRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class InterestService
{
    private PolicyInterestRepositoryInterface $policyInterests;
    private InterestRepositoryInterface $interests;
    private PlayerRepositoryInterface $players;

    public function __construct(PolicyInterestRepositoryInterface $policyInterest,
        InterestRepositoryInterface $interest,
        PlayerRepositoryInterface $player)
    {
        $this->policyInterests = $policyInterest;
        $this->interests = $interest;
        $this->players = $player;
    }

    public function getPlayers($id)
    {
        return $this->players->getWhereMany(["project_id" => $id]);
    }

    public function getInterests($id)
    {
        return $this->interests->getWhereMany(["project_id" => $id]);
    }

    public function getDetail($id)
    {
        return $this->policyInterests->detail($id);
    }

    public function insert($data, $id)
    {
        try{
            DB::beginTransaction();
            $this->policyInterests->create([
                "player_id" => $data->player,
                "interest_id"  => $data->interest_type,
                "interest"  => $data->interest,
                "priority"  => $data->priority,
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
            $this->policyInterests->update($id, [
                "player_id" => $data->player,
                "interest_id"  => $data->interest_type,
                "interest"  => $data->interest,
                "priority"  => $data->priority
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
            $this->policyInterests->delete($id);
            DB::commit();

            return true;
        }
        catch(Throwable $e){
            DB::rollBack();
            return false;
        }
    }

    public function getInterestInstance()
    {
        return $this->policyInterests->getEloquentInstance();
    }
}