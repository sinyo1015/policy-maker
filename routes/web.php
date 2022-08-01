<?php

use App\Http\Controllers\Player\PlayerController;
use App\Http\Controllers\Policy\ProjectPoliciesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\ProjectDetailController;
use App\Http\Controllers\Project\ProjectPropertiesController;

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
});


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
        Route::get("/", [ProjectPoliciesController::class, 'index'])->name("project_policies.index");
        Route::post("/", [ProjectPoliciesController::class, 'store'])->name("project_policies.create");
        Route::post("/edit", [ProjectPoliciesController::class, 'update'])->name("project_policies.update");
        Route::delete("/{policy_id}", [ProjectPoliciesController::class, 'destroy'])->name("project_policies.delete");
    });

    Route::group(['prefix' => "players"], function(){
        Route::get("/", [PlayerController::class, 'index'])->name("project_player.index");
        Route::get("/create", [PlayerController::class, 'create'])->name("project_player.create");
        Route::post("/create", [PlayerController::class, 'store'])->name("project_player.create_action");
        Route::get("/edit/{player_id}", [PlayerController::class, 'edit'])->name("project_player.edit");
        Route::post("/edit/{player_id}", [PlayerController::class, 'update'])->name("project_player.edit_action");
        Route::delete("/delete/{player_id}", [PlayerController::class, 'destroy'])->name("project_player.delete");
    });
    
});

