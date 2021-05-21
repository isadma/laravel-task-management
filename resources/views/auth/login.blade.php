@extends("layout.app")

@section("title", "Login")

@section("css")
@endsection

@section("content")
    <div class="row justify-content-md-center">
        <div class="col-sm-6 col-md-4 ">
            <div class="card">
                <h5 class="card-header">Login</h5>
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{route("login")}}">
                        @csrf
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error("email") is-invalid @enderror" name="email" id="email" value="{{old("email")}}" required>
                            @error("email")
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error("password") is-invalid @enderror" name="password" id="password" min="8" required>
                            @error("password")
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
@endsection
