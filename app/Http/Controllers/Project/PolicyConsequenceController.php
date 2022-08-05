<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\Consequences\ConsequenceRequest;
use App\Models\PolicyConsequence;
use App\Services\ConsequenceService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PolicyConsequenceController extends Controller
{
    private ConsequenceService $consequenceService;

    public function __construct(ConsequenceService $consequenceService)
    {
        $this->consequenceService = $consequenceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $projects = $this->consequenceService
                ->getConsequencesEloquentInstance()
                ->query()
                ->with(["player", "consequence"]);

            return DataTables::of($projects)
                ->addIndexColumn()
                ->addColumn("edit_link", fn($item) => route("project_consequences.edit", [$id, $item->id]))
                ->addColumn("delete_link", fn($item) => route("project_consequences.delete", [$id, $item->id]))
                ->make();
        }

        return view("pages.project.consequences.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $players = $this->consequenceService->getPlayers($id);
        $consequences = $this->consequenceService->getConsequences($id);

        return view("pages.project.consequences.create", compact("players", "consequences", "id"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsequenceRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat membuat konsekuensi");

        if(!$this->consequenceService->insert($request, $id)) 
            return return_json([], 403, "Terjadi kesalahan saat membuat konsekuensi");

        return return_json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolicyConsequence  $policyConsequence
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyConsequence $policyConsequence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PolicyConsequence  $policyConsequence
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $policyConsequenceId)
    {
        $players = $this->consequenceService->getPlayers($id);
        $consequences = $this->consequenceService->getConsequences($id);

        $data = $this->consequenceService->getConsequencesDetail($policyConsequenceId);

        return view("pages.project.consequences.edit", compact("players", "consequences", "data", "id"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PolicyConsequence  $policyConsequence
     * @return \Illuminate\Http\Response
     */
    public function update(ConsequenceRequest $request, $id, $policyConsequenceId)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah konsekuensi");

        if(!$this->consequenceService->update($policyConsequenceId, $request)) 
            return return_json([], 403, "Terjadi kesalahan saat mengubah konsekuensi");

        return return_json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolicyConsequence  $policyConsequence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $policyConsequence, $id, $policyConsequenceId)
    {
        if(!$this->consequenceService->delete($policyConsequenceId))
            return return_json([], 403, "Terjadi kesalahan saat menghapus project");

        return return_json();
    }
}
