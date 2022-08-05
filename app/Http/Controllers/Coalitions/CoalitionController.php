<?php

namespace App\Http\Controllers\Coalitions;

use App\Http\Controllers\Controller;
use App\Services\PlayerService;
use Illuminate\Http\Request;

class CoalitionController extends Controller
{
    private PlayerService $player;

    public function __construct(PlayerService $player)
    {
        $this->player = $player;
    }

    public function showMap(Request $request, $id)
    {
        $data = $this->player->getGroupedCoalitions($id);

        return view("pages.project.coalitions.index", compact("data", "id"));
    }

    public function updatePos(Request $request, $id)
    {
        if(!$this->player->updatePlayerPos($request, $request->player_id))
            return return_json([], 403, "Terjadi kesalahan saat mengubah posisi pihak");
        return return_json();
    }
}
