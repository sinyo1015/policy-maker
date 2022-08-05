<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\OpportunityObstacles\OpportunityObstacleRequest;
use App\Models\OpportunityObstacle;
use App\Services\OpportunityObstacleService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OpportunityObstacleController extends Controller
{
    private OpportunityObstacleService $opsService;

    public function __construct(OpportunityObstacleService $opsService)
    {
        $this->opsService = $opsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $query = $this->opsService->getEloquentInstance()
                ->query()
                ->with(["player"])
                ->where("project_id", $id);

            return DataTables::of($query)
                ->addColumn("delete_link", fn ($data) => route("project_opp_obs.delete", [$id, $data->id]))
                ->addIndexColumn()
                ->make();
        }

        $players = $this->opsService->getPlayers($id);

        return view("pages.project.opportunity_obstacles.index", compact("players", "id"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpportunityObstacleRequest $request, $id)
    {
        if ($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat membuat entri");

        if (!$this->opsService->insert($request, $id))
            return return_json([], 403, "Terjadi kesalahan saat membuat entri");

        return return_json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpportunityObstacle  $opportunityObstacle
     * @return \Illuminate\Http\Response
     */
    public function show(OpportunityObstacle $opportunityObstacle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpportunityObstacle  $opportunityObstacle
     * @return \Illuminate\Http\Response
     */
    public function edit(OpportunityObstacle $opportunityObstacle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpportunityObstacle  $opportunityObstacle
     * @return \Illuminate\Http\Response
     */
    public function update(OpportunityObstacleRequest $request, $id)
    {
        if ($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah entri");

        if (!$this->opsService->update($request, $request->ops_id))
            return return_json([], 403, "Terjadi kesalahan saat mengubah entri");

        return return_json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpportunityObstacle  $opportunityObstacle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $opsId)
    {
        if (!$this->opsService->delete($opsId))
            return return_json([], 403, "Terjadi kesalahan saat menghapus entri");

        return return_json();
    }
}
