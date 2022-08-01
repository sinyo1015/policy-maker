<?php

namespace App\Http\Controllers\Policy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Policies\PolicyEditRequest;
use App\Http\Requests\Policies\PolicyRequest;
use App\Models\ProjectPolicies;
use App\Services\AgendaService;
use App\Services\PolicyService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectPoliciesController extends Controller
{

    private PolicyService $service;
    private AgendaService $agendaService;

    public function __construct(
        PolicyService $service,
        AgendaService $agendaService)
    {
        $this->service = $service;
        $this->agendaService = $agendaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $project_id)
    {
        if($request->ajax())
        {
            $query = $this->service->getEloquentInstance()
                    ->query()
                    ->with(["agenda"])
                    ->where("project_id", $project_id);

            return DataTables::of($query)
                ->addColumn("agenda_name", fn ($data) => $data->agenda?->name)
                ->addColumn("sub_policy_id", fn($data) => $data->id)
                ->addColumn("delete_link", fn($data) => route("project_policies.delete", [$project_id, $data->id]))
                ->addColumn("priority_msg", fn($data) => \App\Constants\AgendaPriority::message($data->priority))
                ->addIndexColumn()
                ->make();
        }

        $agendas = $this->agendaService->getAllAgendas();

        return view("pages.project.policies.index", compact("agendas", "project_id"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PolicyRequest $request)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat membuat project");

        if(!$this->service->insert($request)) 
            return return_json([], 403, "Terjadi kesalahan saat membuat project");

        return return_json();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectPolicies  $projectPolicies
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectPolicies $projectPolicies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectPolicies  $projectPolicies
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectPolicies $projectPolicies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectPolicies  $projectPolicies
     * @return \Illuminate\Http\Response
     */
    public function update(PolicyEditRequest $request)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah project");

        if(!$this->service->update($request->policy_id, $request)) 
            return return_json([], 403, "Terjadi kesalahan saat mengubah project");

        return return_json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectPolicies  $projectPolicies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->service->delete($id))
            return return_json([], 403, "Terjadi kesalahan saat menghapus tujuan");

        return return_json();
    }
}
