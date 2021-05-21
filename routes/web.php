<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (){
    Route::get("/", "HomeController@index")->name("home");

    Route::resource("projects", "ProjectController")->only(["store", "update", "destroy"]);
    Route::post("tasks/priority/update", "TaskController@priority")->name("tasks.priority.update");
    Route::resource("tasks", "TaskController")->only(["store", "update", "destroy"]);
});
