<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectDetailController extends Controller
{
    private ProjectService $project;

    public function __construct(ProjectService $project)
    {
        $this->project = $project;
    }

    public function index(Request $request, $id)
    {
        $data = $this->project->getDetail($id);

        return view('pages.project.index', compact("data"));
    }
}
