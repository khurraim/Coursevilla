@extends('layouts.frontend')

@section('body')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <strong class="card-title">Enter Your New Password</strong>
            </div>
            <div class="card-body">
                <form method="post" action="{{url('ResetEvaluatorPassword')}}">

                    <div class="form-group">
                        <label class="form-label">Password:</label>
                        <input type="password" name="Email" value="{{$email}}" class="form-control" disabled>
                    </div>                       

                    <div class="form-group">
                        <label class="form-label">Password:</label>
                        <input type="password" name="Password" class="form-control" placeholder="Enter Password.....">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password:</label>
                        <input type="password" name="ConfirmPassword" class="form-control" placeholder="Enter Password.....">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Reset Password" />

                </form>
            </div>
        </div>
    </div>
</div>
@endsection