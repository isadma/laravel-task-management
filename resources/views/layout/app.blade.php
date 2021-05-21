<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="https://code.jquery.com/git/ui/jquery-ui-git.css" rel="stylesheet">
        <title>@yield("title") - Task | Maksat Meredov</title>

        @yield("css")

        <style>
            .spinner {
                position: fixed;
                width: 100%;
                height: 100%;
                z-index: 1000;
                left: 0;
                opacity: 0.8;
                background-color: white;
                filter: alpha(opacity=50);
            }
        </style>
    </head>
    <body>
        <div class="spinner d-none">
            <div class="d-flex justify-content-center" style="padding-top: 45vh;">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden text-light">Loading...</span>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route("home")}}">Task Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    @auth
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a href="javascript:void(0)" onclick="this.parentElement.submit();" class="nav-link">Logout</a>
                                </form>
                            </li>
                        </ul>
                    @endauth
                    @guest
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route("login")}}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route("register")}}">Register</a>
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            @yield("content")
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://kit.fontawesome.com/df71a0556b.js" crossorigin="anonymous"></script>
        @yield("js")
    </body>
</html>
