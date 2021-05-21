<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $projects = Project::with("tasks")
            ->where("user_id", auth()->id())
            ->get();
        return view("index", compact("projects"));
    }
}
