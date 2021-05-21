@extends("layout.app")

@section("title", "Home")

@section("css")
    <style>
        .list-group-item-action:hover{
            cursor: pointer !important;
        }
        .dropdown-item:hover{
            cursor: pointer !important;
        }
        .icon:hover{
            cursor: pointer !important;
        }
    </style>
@endsection

@section("content")
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-6 col-12 mb-2">
                    @if(count($projects) > 1)
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Project: {{$projects->where("id", request()->get("project"))->first()->name ?? "All"}}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route("home")}}">All</a></li>
                                @foreach($projects as $project)
                                    <li><a class="dropdown-item" href="{{route("home", ["project" => $project->id])}}">{{$project->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="col-md-6 col-12 mb-2 text-md-end">
                    <!-- Add Project Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProject">
                        Add project
                    </button>

                    <!-- Add Project Modal -->
                    <div class="modal fade text-start" id="createProject" tabindex="-1" aria-labelledby="createProjectLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createProjectLabel">New project</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{route("projects.store")}}">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control @error("name") is-invalid @enderror" name="name" id="name" value="{{old("name")}}" required>
                                            @error("name")
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if(count($projects) > 0)
                        <!-- Add Task Button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTask">
                            Add task
                        </button>

                        <!-- Add Task Modal -->
                        <div class="modal fade text-start" id="createTask" tabindex="-1" aria-labelledby="createTaskLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createTaskLabel">New task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{route("tasks.store")}}">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="col-md-12">
                                                <label for="project_id" class="form-label">Project</label>
                                                <select class="form-control @error("project_id") is-invalid @enderror" name="project_id" id="project_id" required>
                                                    <option disabled selected value="">Choose a project</option>
                                                    @foreach($projects as $project)
                                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error("project_id")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control @error("name") is-invalid @enderror" name="name" id="name" value="{{old("name")}}" required>
                                                @error("name")
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($projects->whereIn("id", request()->has("project") ? [request()->get("project")] : $projects->pluck("id")) as $project)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">
                                <span style="float: left;">{{$project->name}}</span>
                                <span style="float: right;">
                                    <a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" data-bs-toggle="modal" data-bs-target="#updateProject{{$project->id}}"><i class="fas fa-edit icon"></i></a>

                                    <div class="modal fade text-start" id="updateProject{{$project->id}}" tabindex="-1" aria-labelledby="updateProject{{$project->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateProject{{$project->id}}Label">{{$project->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="{{route("projects.update", $project->id)}}">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method("PUT")
                                                        <div class="col-md-12">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{$project->name}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route("projects.destroy", $project->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0)" onclick="if (confirm('Do you want to delete this project?')) {this.parentElement.submit();}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                                            <i class="fas fa-trash icon"></i>
                                        </a>
                                    </form>
                                </span>
                            </div>
                            <div class="card-body">
                                <ul class="list-group sortable">
                                    @forelse($project->tasks->sortBy("priority") as $task)
                                        <li class="list-group-item" data-task="{{$task->id}}">
                                            {{$task->name}}
                                            <span style="float: right;">
                                                <a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" data-bs-toggle="modal" data-bs-target="#updateTask{{$task->id}}"><i class="fas fa-edit icon"></i></a>

                                                <div class="modal fade text-start" id="updateTask{{$task->id}}" tabindex="-1" aria-labelledby="updateTask{{$task->id}}Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateTask{{$task->id}}Label">{{$task->name}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="{{route("tasks.update", $task->id)}}">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    @method("PUT")
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Project</label>
                                                                        <select class="form-control" name="project_id" required>
                                                                            @foreach($projects as $item)
                                                                                <option value="{{$item->id}}" {{$item->id == $task->project_id ? "selected": ""}}>{{$item->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Name</label>
                                                                        <input type="text" class="form-control" name="name" value="{{$task->name}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ route("tasks.destroy", $task->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:void(0)" onclick="if (confirm('Do you want to delete this task?')) {this.parentElement.submit();}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                                                        <i class="fas fa-trash icon"></i>
                                                    </a>
                                                </form>
                                            </span>
                                        </li>
                                    @empty
                                        <p>No task</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center">
                        <h5>No task</h5>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        const spinner = $(".spinner");
        $( function() {
            $( ".sortable" ).sortable({
                stop: function( event, ui ) {
                    $.ajax({
                        type: 'POST',
                        url: "{{route("tasks.priority.update")}}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': "application/json"
                        },
                        data: {
                            task_id: ui.item.attr("data-task"),
                            priority: ui.item.index() + 1
                        },
                        beforeSend: function() {
                            spinner.removeClass("d-none");
                        },
                        error: function(error) {
                            alert("Sorry, something went wrong.")
                            console.log(error);
                        },
                        complete: function() {
                            spinner.addClass("d-none");
                        }
                    });
                }
            });
        } );

    </script>
@endsection
