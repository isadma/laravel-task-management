<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(ProjectRequest $request){
        Project::create([
            "user_id" => auth()->id(),
            "name" => $request->get("name")
        ]);
        return $this->created();
    }

    public function update(ProjectRequest $request, Project $project){
        if ($project->user_id != auth()->id()){
            return $this->error("Invalid project.");
        }
        $project->update([
            "name" => $request->get("name")
        ]);
        return $this->updated();
    }

    public function destroy(Project $project){
        if ($project->user_id != auth()->id()){
            return $this->error("Invalid project.");
        }
        foreach ($project->tasks as $task){
            $task->delete();
        }
        $project->delete();
        return $this->deleted();
    }
}
