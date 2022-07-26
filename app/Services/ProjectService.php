<?php

namespace App\Services;

use App\Repositories\ProjectImplementationLabels\ProjectImplementationLabelsInterface;
use App\Repositories\Projects\ProjectRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProjectService
{
    private ProjectRepositoryInterface $projectRepository;
    private ProjectImplementationLabelsInterface $projectImpl;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        ProjectImplementationLabelsInterface $projectImpl)
    {
        $this->projectRepository = $projectRepository;
        $this->projectImpl = $projectImpl;
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
