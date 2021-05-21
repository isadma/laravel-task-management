<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskPriority;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private function get_maximum_priority() : int
    {
        return Task::where("project_id", request()->get("project_id"))->max("priority") ?? 0;
    }

    public function store(TaskRequest $request){
        Task::create([
            "user_id" => auth()->id(),
            "project_id" => $request->get("project_id"),
            "name" => $request->get("name"),
            "priority" => $this->get_maximum_priority() + 1,
        ]);
        return $this->created();
    }

    public function update(TaskRequest $request, Task $task){
        if ($task->user_id != auth()->id()){
            return $this->error("Invalid task.");
        }
        $task->update([
            "project_id" => $request->get("project_id"),
            "name" => $request->get("name")
        ]);
        return $this->updated();
    }

    public function destroy(Task $task){
        if ($task->user_id != auth()->id()){
            return $this->error("Invalid task.");
        }
        $task->delete();
        return $this->deleted();
    }

    public function priority(TaskPriority $request){
        $task = Task::findOrFail($request->get("task_id"));
        $new_priority = (int) $request->get("priority");

        $tasks = Task::query()->where("project_id", $task->project_id);

        if ($task->priority < $new_priority){
            $from = $task->priority;
            $tasks->where("priority", ">", $task->priority)
                ->where("priority", "<=", $new_priority);

            foreach ($tasks->get() as $item){
                $item->update([
                    "priority" => $from
                ]);
                $from++;
            }
        }
        else{
            $from = $new_priority;
            $tasks->where("priority", ">=", $new_priority)
                ->where("priority", "<", $task->priority);
            foreach ($tasks->get() as $item){
                $from++;
                $item->update([
                    "priority" => $from
                ]);
            }
        }

        $task->update([
            "priority" => $new_priority
        ]);

        return $this->apiSuccessResponse([]);
    }
}
