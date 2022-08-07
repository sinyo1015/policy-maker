<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\Strategies\StrategyRequest;
use App\Models\Strategy;
use App\Services\StrategyService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StrategyController extends Controller
{

    private StrategyService $strategyService;

    public function __construct(StrategyService $strategyService)
    {
        $this->strategyService = $strategyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $projects = $this->strategyService->getEloquentInstance()
                ->query()
                ->with(["player"]);

            return DataTables::of($projects)
                ->addIndexColumn()
                ->addColumn("edit_link", fn($item) => route("project.edit", $item->id))
                ->addColumn("delete_link", fn($item) => route("project_predefined_strategy.delete", [$id, $item->id]))
                ->addColumn("open_project_link", fn($item) => route("project_detail.index", $item->id))
                ->make();
        }

        return view("pages.project.predefined_strategies.index", compact("id"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $players = $this->strategyService->getGrouppedPlayer($id);

        return view("pages.project.predefined_strategies.create", compact("players", "id"));
    }

    public function getStrategies(Request $request, $id)
    {
        return return_json($this->strategyService->getStrategiesByCategory($id, $request->strategy_type));
    }

    public function getPlayerOpses(Request $request, $id)
    {
        return return_json($this->strategyService->getOpses($request->player_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StrategyRequest $request, $id)
    {
        if ($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat menambahkan entri");

        if (!$this->strategyService->insertEntry($request, $id))
            return return_json([], 403, "Terjadi kesalahan saat menambahkan entri");

        return return_json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function show(Strategy $strategy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function edit(Strategy $strategy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Strategy $strategy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $strategyId)
    {
        if(!$this->strategyService->delete($strategyId))
            return return_json([], 403, "Terjadi kesalahan saat menghapus strategi");

        return return_json();
    }
}
