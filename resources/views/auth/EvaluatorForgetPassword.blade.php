@extends('layouts.frontend')
@section('body')
<main class="login-form">
    <div class="container my-5">

                    @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Enter Your Email</h3>
                    <div class="card-body">
                        <form method="POST" action="/evaluator-forget-password">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                    autofocus>
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Send Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>

               

            </div>
        </div>
    </div>
</main>
@endsection