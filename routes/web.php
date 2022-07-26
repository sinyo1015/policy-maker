<?php

use App\Http\Controllers\Policy\ProjectPoliciesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\ProjectDetailController;

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

    Route::group(['prefix' => "policies"], function(){
        Route::get("/", [ProjectPoliciesController::class, 'index'])->name("project_policies.index");
        Route::post("/", [ProjectPoliciesController::class, 'store'])->name("project_policies.create");
        Route::post("/edit", [ProjectPoliciesController::class, 'update'])->name("project_policies.update");
        Route::delete("/{policy_id}", [ProjectPoliciesController::class, 'destroy'])->name("project_policies.delete");
    });
    
});

