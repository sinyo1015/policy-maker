<?php

namespace App\Services;

use App\Repositories\SuggestedStrategies\SuggestedStrategyRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class SuggestedStrategyService
{
    private SuggestedStrategyRepositoryInterface $suggestedStrategies;

    public function __construct(SuggestedStrategyRepositoryInterface $suggestedStrategies)
    {
        $this->suggestedStrategies = $suggestedStrategies;
    }

    public function insert($data, $id)
    {
        try{
            DB::beginTransaction();
            $this->suggestedStrategies->create([
                "label" => $data->label,
                "text" => $data->contents,
                "category" => $data->strategy_type, //See App\Constants\Strategies\StrategyCategory
                "type" => $data->support_type, //See App\Constants\Strategies\StrategyType,
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
            $this->suggestedStrategies->update($id, [
                "label" => $data->label,
                "text" => $data->contents,
                "category" => $data->strategy_type, //See App\Constants\Strategies\StrategyCategory
                "type" => $data->support_type, //See App\Constants\Strategies\StrategyType
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
            $this->suggestedStrategies->delete($id);
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
        return $this->suggestedStrategies->getEloquentInstance();
    }

}