<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Projects\ProjectRequest;

class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = $this->projectService->getEloquentInstance()->query();

            return DataTables::of($projects)
                ->addColumn("created_at_text", function ($data) {
                    return $data->created_at->format("d/m/Y");
                })
                ->addIndexColumn()
                ->addColumn("edit_link", fn($item) => route("project.edit", $item->id))
                ->addColumn("delete_link", fn($item) => route("project.delete", $item->id))
                ->addColumn("open_project_link", fn($item) => route("project_detail.index", $item->id))
                ->make();
        }

        return view("pages.projects.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat membuat project");

        if(!$this->projectService->insert($request)) 
            return return_json([], 403, "Terjadi kesalahan saat membuat project");

        return return_json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->projectService->getDetail($id);

        return view("pages.projects.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah project");

        if(!$this->projectService->update($id, $request)) 
            return return_json([], 403, "Terjadi kesalahan saat mengubah project");

        return return_json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->projectService->delete($id))
            return return_json([], 403, "Terjadi kesalahan saat menghapus project");

        return return_json();
    }
}
