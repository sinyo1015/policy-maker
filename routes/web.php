<?php

use App\Http\Controllers\Coalitions\CoalitionController;
use App\Http\Controllers\Player\PlayerController;
use App\Http\Controllers\Policy\PoliciesController;
use App\Http\Controllers\Project\OpportunityObstacleController;
use App\Http\Controllers\Project\PolicyConsequenceController;
use App\Http\Controllers\Project\PolicyInterestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\ProjectDetailController;
use App\Http\Controllers\Project\ProjectPropertiesController;
use App\Http\Controllers\Project\StrategyController;
use App\Http\Controllers\Project\SuggestedStrategyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name("homepage");


Route::group(['prefix' => "projects"], function(){
    Route::get("/", [ProjectController::class, 'index'])->name("project.index");
    Route::get("create", [ProjectController::class, 'create'])->name("project.create");
    Route::post("create", [ProjectController::class, 'store'])->name("project.create_action");
    Route::get("edit/{id}", [ProjectController::class, 'edit'])->name("project.edit");
    Route::post("edit/{id}", [ProjectController::class, 'update'])->name("project.edit_action");
    Route::delete("delete/{id}", [ProjectController::class, 'destroy'])->name("project.delete");
});


Route::group(['prefix' => "project/{id}", 'middleware' => ["project_detail"]], function(){
    Route::get("/", [ProjectDetailController::class, 'index'])->name("project_detail.index");
    Route::get("/properties", [ProjectPropertiesController::class, 'index'])->name("project_detail.properties_index");
    Route::get("/get_properties", [ProjectPropertiesController::class, 'getAllList'])->name("project_detail.get_lists");
    Route::post("/insert_property", [ProjectPropertiesController::class, 'insertEntry'])->name("project_detail.insert_entry");
    Route::post("/insert_questionnaire", [ProjectPropertiesController::class, 'saveQuestionnaires'])->name("project_detail.insert_questionnaire");
    Route::post("/update_questionnaire", [ProjectPropertiesController::class, 'updateQuestionnaire'])->name("project_detail.update_questionnaire");
    Route::get("/get_questionnaires", [ProjectPropertiesController::class, 'getQuestionnaires'])->name("project_detail.get_questionnaires");
    Route::delete("/delete_questionnaires", [ProjectPropertiesController::class, 'deleteQuestionnaire'])->name("project_detail.delete_questionnaires");
    Route::post("/update_scales", [ProjectPropertiesController::class, 'saveScales'])->name("project_detail.update_scales");
    Route::get("/get_scales", [ProjectPropertiesController::class, 'getScales'])->name("project_detail.get_scales");

    Route::group(['prefix' => "policies"], function(){
        Route::get("/", [PoliciesController::class, 'index'])->name("project_policies.index");
        Route::post("/", [PoliciesController::class, 'store'])->name("project_policies.create");
        Route::post("/edit", [PoliciesController::class, 'update'])->name("project_policies.update");
        Route::delete("/{policy_id}", [PoliciesController::class, 'destroy'])->name("project_policies.delete");
    });

    Route::group(['prefix' => "players"], function(){
        Route::get("/", [PlayerController::class, 'index'])->name("project_player.index");
        Route::get("/create", [PlayerController::class, 'create'])->name("project_player.create");
        Route::post("/create", [PlayerController::class, 'store'])->name("project_player.create_action");
        Route::get("/edit/{player_id}", [PlayerController::class, 'edit'])->name("project_player.edit");
        Route::post("/edit/{player_id}", [PlayerController::class, 'update'])->name("project_player.edit_action");
        Route::delete("/delete/{player_id}", [PlayerController::class, 'destroy'])->name("project_player.delete");

        Route::get("/map", [PlayerController::class, 'showMap'])->name("project_player.map");
        Route::get("/feasibility", [PlayerController::class, 'showFeasibility'])->name("project_player.feasibility");
    });

    Route::group(['prefix' => "consequences"], function(){
        Route::get("/", [PolicyConsequenceController::class, "index"])->name("project_consequences.index");
        Route::get("/create", [PolicyConsequenceController::class, "create"])->name("project_consequences.create");
        Route::post("/create", [PolicyConsequenceController::class, "store"])->name("project_consequences.create_action");
        Route::get("/edit/{consequence_id}", [PolicyConsequenceController::class, "edit"])->name("project_consequences.edit");
        Route::post("/edit/{consequence_id}", [PolicyConsequenceController::class, "update"])->name("project_consequences.edit_action");
        Route::delete("/delete/{consequence_id}", [PolicyConsequenceController::class, "destroy"])->name("project_consequences.delete");
    });

    Route::group(['prefix' => "interests"], function(){
        Route::get("/", [PolicyInterestController::class, "index"])->name("project_interests.index");
        Route::get("/create", [PolicyInterestController::class, "create"])->name("project_interests.create");
        Route::post("/create", [PolicyInterestController::class, "store"])->name("project_interests.create_action");
        Route::get("/edit/{interest_id}", [PolicyInterestController::class, "edit"])->name("project_interests.edit");
        Route::post("/edit/{interest_id}", [PolicyInterestController::class, "update"])->name("project_interests.edit_action");
        Route::delete("/delete/{interest_id}", [PolicyInterestController::class, "destroy"])->name("project_interests.delete");
    });

    Route::group(['prefix' => "coalitions"], function(){
        Route::get("/map", [CoalitionController::class, "showMap"])->name("project_coalitions.show_map");
        Route::post("/player_position", [CoalitionController::class, "updatePos"])->name("project_coalitions.update_player_pos");
    });

    Route::group(['prefix' => "opportunity_obstacles"], function(){
        Route::get("/", [OpportunityObstacleController::class, "index"])->name("project_opp_obs.index");
        Route::post("create", [OpportunityObstacleController::class, "store"])->name("project_opp_obs.create");
        Route::post("edit", [OpportunityObstacleController::class, "update"])->name("project_opp_obs.edit_action");
        Route::delete("/delete/{ops_id}", [OpportunityObstacleController::class, "destroy"])->name("project_opp_obs.delete");
    });

    Route::group(['prefix' => "strategies"], function(){
        Route::get("/", [SuggestedStrategyController::class, "index"])->name("project_strategies.index");
        Route::post("/", [SuggestedStrategyController::class, "store"])->name("project_strategies.create_action");
        Route::post("edit", [SuggestedStrategyController::class, "update"])->name("project_strategies.edit_action");
        Route::delete("/{strategy_id}", [SuggestedStrategyController::class, "destroy"])->name("project_strategies.delete");
    });

    Route::group(['prefix' => "predefined_strategies"], function(){
        Route::get("/", [StrategyController::class, "index"])->name("project_predefined_strategy.index");
        Route::get("create", [StrategyController::class, "create"])->name("project_predefined_strategy.create");
        Route::post("create", [StrategyController::class, "store"])->name("project_predefined_strategy.create_action");
        Route::get("get_strategies", [StrategyController::class, "getStrategies"])->name("project_predefined_strategy.get_strategies");
        Route::get("get_player_opses", [StrategyController::class, "getPlayerOpses"])->name("project_predefined_strategy.get_opses");
        Route::get("edit/{strategy_id}", [StrategyController::class, "edit"])->name("project_predefined_strategy.edit");
        Route::post("edit/{strategy_id}", [StrategyController::class, "update"])->name("project_predefined_strategy.edit_action");
        Route::delete("/{strategy_id}", [StrategyController::class, "destroy"])->name("project_predefined_strategy.delete");
        Route::get("/{strategy_id}", [StrategyController::class, "show"])->name("project_predefined_strategy.detail");
    });
    
});

