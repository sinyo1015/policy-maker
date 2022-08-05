<?php

namespace App\Http\Controllers\Project;

use App\Constants\Strategies\StrategyCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\SuggestedStrategies\SuggestedStrategyRequest;
use App\Models\SuggestedStrategy;
use App\Services\SuggestedStrategyService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SuggestedStrategyController extends Controller
{
    private SuggestedStrategyService $suggestedStrategy;

    public function __construct(SuggestedStrategyService $suggestedStrategy)
    {
        $this->suggestedStrategy = $suggestedStrategy;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        
        if($request->ajax())
        {
            $query = $this->suggestedStrategy->getEloquentInstance()
                    ->query()
                    ->where("project_id", $id)
                    ->where("category", $request->category);

            return DataTables::of($query)
                ->addColumn("delete_link", fn($data) => route("project_strategies.delete", [$id, $data->id]))
                ->addIndexColumn()
                ->make();
        }


        return view("pages.project.strategies.index", compact("id"));
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
    public function store(SuggestedStrategyRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat menambahkan strategi");

        if(!$this->suggestedStrategy->insert($request, $id)) 
            return return_json([], 403, "Terjadi kesalahan saat menambahkan strategi");

        return return_json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuggestedStrategy  $suggestedStrategy
     * @return \Illuminate\Http\Response
     */
    public function show(SuggestedStrategy $suggestedStrategy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuggestedStrategy  $suggestedStrategy
     * @return \Illuminate\Http\Response
     */
    public function edit(SuggestedStrategy $suggestedStrategy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuggestedStrategy  $suggestedStrategy
     * @return \Illuminate\Http\Response
     */
    public function update(SuggestedStrategyRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah strategi");

        if(!$this->suggestedStrategy->update($request, $request->strategy_id)) 
            return return_json([], 403, "Terjadi kesalahan saat mengubah strategi");

        return return_json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuggestedStrategy  $suggestedStrategy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $strategyId)
    {
        if(!$this->suggestedStrategy->delete($strategyId))
            return return_json([], 403, "Terjadi kesalahan saat menghapus strategi");

        return return_json();
    }
}
