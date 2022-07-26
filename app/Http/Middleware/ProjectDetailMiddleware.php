<?php

namespace App\Http\Middleware;

use App\Services\ProjectService;
use Closure;
use Illuminate\Http\Request;

class ProjectDetailMiddleware
{
    private ProjectService $project;

    public function __construct(ProjectService $project)
    {
        $this->project = $project;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $data = $this->project->getStandaloneDetail($request->id);
        $request->attributes->add(['project' => $data]);
        return $next($request);
    }
}
