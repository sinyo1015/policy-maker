<?php

namespace App\Services;

use App\Models\MasterSuggestedStrategy;
use App\Repositories\ProjectImplementationLabels\ProjectImplementationLabelsInterface;
use App\Repositories\Projects\ProjectRepositoryInterface;
use App\Repositories\SuggestedStrategies\SuggestedStrategyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProjectService
{
    private ProjectRepositoryInterface $projectRepository;
    private ProjectImplementationLabelsInterface $projectImpl;
    private SuggestedStrategyRepositoryInterface $strategy;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        ProjectImplementationLabelsInterface $projectImpl,
        SuggestedStrategyRepositoryInterface $strategy)
    {
        $this->projectRepository = $projectRepository;
        $this->projectImpl = $projectImpl;
        $this->strategy = $strategy;
    }

    public function getStandaloneDetail($id)
    {
        return $this->projectRepository->detail($id); 
    }

    public function getEloquentInstance()
    {
        return $this->projectRepository->getEloquentInstance();
    }


    public function getProjects()
    {
        return $this->projectRepository->getAll();
    }

    public function populateStrategies($id)
    {
        $data = MasterSuggestedStrategy::all();

        foreach($data as $_data){
            $this->strategy->create([
                "label" => $_data->label,
                "text" => $_data->text,
                "category" => $_data->category, //See App\Constants\Strategies\StrategyCategory
                "type" => $_data->type, //See App\Constants\Strategies\StrategyType,
                "project_id" => $id
            ]);
        }
    }

    public function insert($data)
    {
        try{
            DB::beginTransaction();
            $project = $this->projectRepository->create([
                "name" => $data->project_name,
                "analyst_name" => $data->analyst_name,
                "client_name" => $data->client_name,
                "description" => $data->description,
                "policy_date" => $data->policy_date,
                "analysis_date" => $data->analysis_date,
            ]);

            foreach($data->implementation_periods_labels as $impl){
                $this->projectImpl->create(["label" => $impl['name'], "project_id" => $project->id]);
            }

            $this->populateStrategies($project->id);

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
            $this->projectRepository->update($id, [
                "name" => $data->project_name,
                "analyst_name" => $data->analyst_name,
                "client_name" => $data->client_name,
                "description" => $data->description,
                "policy_date" => $data->policy_date,
                "analysis_date" => $data->analysis_date,
            ]);

            $this->projectImpl->getEloquentInstance()->where("project_id", $id)->delete();

            foreach($data->implementation_periods_labels as $impl){
                $this->projectImpl->create(["label" => $impl['name'], "project_id" => $id]);
            }

            return true;
        }
        catch(Throwable $e){
            return false;
        }
    }

    public function getDetail($id)
    {
        return $this->projectRepository->getEloquentInstance()->with(["labels"])->findOrFail($id);
    }

    public function delete($id)
    {
        try{
            $this->projectRepository->delete($id);

            return true;
        }
        catch(Throwable $e){
            return false;
        }
    }
}
