<?php

namespace App\Http\Controllers\Player;

use App\Constants\PositionScale;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\Players\PlayerRequest;
use App\Models\Player;
use App\Services\PlayerService;
use App\Services\ProjectPropertyService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PlayerController extends Controller
{
    private PlayerService $player;
    private ProjectPropertyService $project;

    public function __construct(PlayerService $player,
        ProjectPropertyService $project)
    {
        $this->player = $player;
        $this->project = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if($request->ajax()){
            $players = $this->player
            ->getEloquentInstance()
            ->query()
            ->with(["level", "sector"])
            ->where(["project_id" => $id]);
    
            $scales = $this->project->getScales($id);
    
            return DataTables::of($players)
                ->addColumn("position_label", function ($data) use($scales){
                    if($data->position <= $scales?->ps_dh)
                        return '<div style="width: 20px; height: 20px; background-color: '. PositionScale::HIGH_OPOSITION_COLOR .'"></div> Sangat Menolak';
                    if($data->position <= $scales?->ps_dml && $data->position <= $scales?->ps_dmh)
                        return '<div style="width: 20px; height: 20px; background-color: '. PositionScale::MEDIUM_OPOSITION_COLOR .'"></div> Penolakan Medium';
                    if($data->position <= $scales?->ps_dll && $data->position <= $scales?->ps_dlh)
                        return '<div style="width: 20px; height: 20px; background-color: '. PositionScale::LOW_OPOSITION_COLOR .'"></div> Penolakan Rendah';
                    if($data->position <= $scales?->ps_nl && $data->position >= $scales?->ps_nh)
                        return '<div style="width: 20px; height: 20px; background-color: '. PositionScale::NON_MOBILIZED_COLOR .'"></div> Netral';
                    if($data->position >= $scales?->ps_sll && $data->position <= $scales?->ps_slh)
                        return '<div style="width: 20px; height: 20px; background-color: '. PositionScale::LOW_SUPPORT_COLOR .'"></div> Support Rendah';
                    if($data->position >= $scales?->ps_sml && $data->position <= $scales?->ps_smh)
                        return '<div style="width: 20px; height: 20px; background-color: '. PositionScale::MEDIUM_SUPPORT_COLOR .'"></div> Support Menengah';
                    if($data->position >= $scales?->ps_sh)
                        return '<div style="width: 20px; height: 20px; background-color: '. PositionScale::HIGH_SUPPORT_COLOR .'"></div> Sangat Mendukung';
                })
                ->addColumn("power_label", function ($data) use($scales){
                    if($data->power <= $scales?->pw_l)
                        return "Rendah";
                    if($data->power >= $scales?->pw_ml && $data->power <= $scales?->pw_mh)
                        return "Menengah";
                    if($data->power >= $scales?->pw_h)
                        return "Tinggi";
                })
                ->rawColumns(["position_label", "power_label"])
                ->addColumn("player_id", fn($data) => $data->id)
                ->addColumn("edit_link", fn($data) => route("project_player.edit", [$id, $data->id]))
                ->addColumn("delete_link", fn($data) => route("project_player.delete", [$id, $data->id]))
                ->addIndexColumn()
                ->make();
        }

        return view("pages.project.players.index", compact("id"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $data = $this->player->getSectorAndLevels($id);
        $dataScale = $this->project->getScales($id);

        return view("pages.project.players.create", compact("data", "dataScale", "id"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerRequest $request, $id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat menambahkan entri");

        if(!$this->player->insertEntry($request, $id))
            return return_json([], 403, "Terjadi kesalahan saat menambahkan entri");

        return return_json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $player_id)
    {
        $data = $this->player->getSectorAndLevels($id);
        $dataScale = $this->project->getScales($id);
        $player = $this->player->getDetails($player_id);

        return view("pages.project.players.edit", compact("data", "dataScale", "id", "player"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerRequest $request, $id, $player_id)
    {
        if($request->validator->fails())
            return return_json(['errors' => $request->errorMessages()], 403, "Terjadi kesalahan saat mengubah entri");

        if(!$this->player->editEntry($request, $player_id))
            return return_json([], 403, "Terjadi kesalahan saat mengubah entri");

        return return_json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $player_id)
    {
        if(!$this->player->delete($player_id))
            return return_json([], 403, "Terjadi kesalahan saat menghapus pihak");

        return return_json();
    }
}
