<?php

namespace App\Services;

use App\Repositories\Policies\PolicyRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class PolicyService
{
    private PolicyRepositoryInterface $policyRepository;

    public function __construct(PolicyRepositoryInterface $policy)
    {
        $this->policyRepository = $policy;
    }

    public function getEloquentInstance()
    {
        return $this->policyRepository->getEloquentInstance();
    }

    public function insert($data)
    {
        try{
            DB::beginTransaction();
            $this->policyRepository->create([
                "goal" => $data->goal,
                "mechanism" => $data->mechanism,
                "indicator" => $data->indicator,
                "priority" => $data->priority,
                "comments" => $data->comments,
                "is_more_research_needed" => $data->is_more_research_needed,
                "agenda_id" => $data->agenda_id,
                "project_id" => $data->project_id
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
            $this->policyRepository->update($id, [
                "goal" => $data->goal,
                "mechanism" => $data->mechanism,
                "indicator" => $data->indicator,
                "priority" => $data->priority,
                "comments" => $data->comments,
                "is_more_research_needed" => $data->is_more_research_needed,
                "agenda_id" => $data->agenda_id
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
            $this->policyRepository->delete($id);

            return true;
        }
        catch(Throwable $e){
            return false;
        }
    }

}