<?php

namespace App\Services;

use App\Repositories\OpportunityObstacles\OpportunityObstacleRepositoryInterface;
use App\Repositories\Players\PlayerRepositoryInterface;
use App\Repositories\Strategies\StrategyRepositoryInterface;
use App\Repositories\SuggestedStrategies\SuggestedStrategyRepositoryInterface;
use Illuminate\Support\Facades\DB;
use stdClass;
use Throwable;

class StrategyService
{
    private PlayerRepositoryInterface $players;
    private ProjectPropertyService $project;
    private SuggestedStrategyRepositoryInterface $strategies;
    private OpportunityObstacleRepositoryInterface $opses;
    private StrategyRepositoryInterface $postStrategies;

    public function __construct(
        PlayerRepositoryInterface $players,
        ProjectPropertyService $project,
        SuggestedStrategyRepositoryInterface $strategy,
        OpportunityObstacleRepositoryInterface $opses,
        StrategyRepositoryInterface $postStrategies
    ) {
        $this->players = $players;
        $this->project = $project;
        $this->strategies = $strategy;
        $this->opses = $opses;
        $this->postStrategies = $postStrategies;
    }

    public function getGrouppedPlayer($id)
    {
        $scales = $this->project->getScales($id);

        $std = new stdClass;
        $std->support = $this->players->getWhereMany([["position", ">", $scales?->ps_sll], ["project_id", "=", $id]]); //DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position > ?", [$scales?->ps_nh]);
        $std->neutral = $this->players->getWhereMany([["position", "<=", $scales?->ps_nl], ["position", ">=", $scales?->ps_nh], ["project_id", "=", $id]]); //DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position <= ? AND position >= ?", [$scales?->ps_nl, $scales?->ps_nh]);
        $std->opposition = $this->players->getWhereMany([["position", "<=", $scales?->ps_dlh], ["project_id", "=", $id]]); //DB::selectOne("SELECT ABS(SUM(position)) as position_sum FROM players WHERE position >= ?", [$scales?->ps_dlh]);

        return $std;
    }

    public function getStrategiesByCategory($id, $type)
    {
        return $this->strategies->getWhereMany([["project_id", "=", $id], ["category", "=", $type]]);
    }

    public function getOpses($player_id)
    {
        return $this->opses->getWhereMany(["player_id" => $player_id]);
    }

    public function insertEntry($data, $id)
    {
        try {
            DB::beginTransaction();
            $this->postStrategies->create([
                "player_id" => $data->player_id,
                "predefined_strategy_id" => $data->selected_strategy_id,
                "strategy_action" => $data->strategy_actions,
                "challanges" => $data->challanges,
                "timelines" => $data->timelines,
                "probability" => $data->probability,
                "project_id" => $id
            ]);
            DB::commit();

            return true;
        } catch (Throwable $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getDetails($id, $projectId)
    {
        $data = $this->postStrategies->getEloquentInstance()->with(["player", "strategy", "player.oops"])->find($id);
        $scales = $this->project->getScales($projectId);

        $isFound = false;

        if ($data?->player?->position > $scales?->ps_sll) {
            if (!$isFound) {
                $isFound = true;
                $data->position_label = "Support";
            }
        }
        if ($data?->player?->position <= $scales?->ps_nl && $data?->player?->position >= $scales?->ps_nh) {
            if (!$isFound) {
                $isFound = true;
                $data->position_label = "Neutral";
            }
        }
        if ($data?->player?->position <= $scales?->ps_dlh) {
            if (!$isFound) {
                $isFound = true;
                $data->position_label = "Opposition";
            }
        }

        return $data;
    }

    public function update($data, $id)
    {
        try {
            DB::beginTransaction();
            $this->postStrategies->update($id, [
                "player_id" => $data->player_id,
                "predefined_strategy_id" => $data->selected_strategy_id,
                "strategy_action" => $data->strategy_actions,
                "challanges" => $data->challanges,
                "timelines" => $data->timelines,
                "probability" => $data->probability
            ]);
            DB::commit();

            return true;
        } catch (Throwable $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getEloquentInstance()
    {
        return $this->postStrategies->getEloquentInstance();
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->postStrategies->delete($id);
            DB::commit();

            return true;
        } catch (Throwable $e) {
            DB::rollBack();

            return false;
        }
    }
}
