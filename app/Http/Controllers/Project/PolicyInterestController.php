<?php

namespace App\Http\Controllers\Project;

use App\Constants\PriorityLevel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\Interests\InterestRequest;
use App\Models\PolicyInterest;
use App\Services\InterestService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PolicyInterestController extends Controller
{
    private InterestService $interestService;

    public function __construct(InterestService $interestService)
    {
        $this->interestService = $interestService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if($request->ajax()){
            $interests = $this->interestService->getInterestInstance()
                ->query()
                ->with(["player", "interest"])
                ->where(["project_id" => $id]);

            return DataTables::of($interests)
                ->addIndexColumn()
                ->addColumn("priority", function($item){
                    switch($item->priority){
                        case PriorityLevel::LOW:
                            return "Rendah";
                        case PriorityLevel::MEDIUM:
                            return "Medium";
                        case PriorityLevel::HIGH:
                            return "Tinggi";
                    }
                })
                ->addColumn("edit_link", fn($item) => route("project_interests.edit", [$id, $item->id]))
                ->addColumn("delete_link", fn($item) => route("project_interests.delete", [$id, $item->id]))
                ->make();
        }

        return view("pages.project.interests.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $players = $this->interestService->getPlayers($id);
        $interests = $this->interestService->getInterests($id);

        return view("pages.project.interests.create", compact("players", "interests", "id"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterestRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat menambahkan interest");

        if(!$this->interestService->insert($request, $id)) 
            return return_json([], 403, "Terjadi kesalahan saat menambahkan interest");

        return return_json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolicyInterest  $policyInterest
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyInterest $policyInterest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PolicyInterest  $policyInterest
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $policyInterestId)
    {
        $players = $this->interestService->getPlayers($id);
        $interests = $this->interestService->getInterests($id);
        $data = $this->interestService->getDetail($id);

        return view("pages.project.interests.edit", compact("players", "interests", "id", "data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PolicyInterest  $policyInterest
     * @return \Illuminate\Http\Response
     */
    public function update(InterestRequest $request, $id, $policyInterestId)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah interest");

        if(!$this->interestService->update($id, $request)) 
            return return_json([], 403, "Terjadi kesalahan saat mengubah interest");

        return return_json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolicyInterest  $policyInterest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $policyInterestId)
    {
        if(!$this->interestService->delete($policyInterestId))
            return return_json([], 403, "Terjadi kesalahan saat menghapus interest");

        return return_json();
    }
}
