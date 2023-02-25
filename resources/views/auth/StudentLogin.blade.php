@extends('layouts.frontend')
@section('body')
<main class="login-form">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Student Login</h3>
                    <div class="card-body">
                        <form method="POST" action="student-login">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Signin</button>
                            </div>
                        </form>

                        <a href="{{ url('/StudentForgetPassword') }}" class="btn text-white my-2 btn-primary btn-block">Reset Password</a>

                    </div>
                </div>

               

            </div>
        </div>
    </div>
</main>
@endsection