@extends('layouts.teacher')
  
@section('body')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center mt-3">Change Password</h3>
        </div>

        <form method="POST" action="{{url('UpdateTeacherPassword')}}">
            @csrf
            <div class="container">
                <div class="form-group my-3">
                    <label for="">Type New Password</label>
                    <input type="password" name="new-password" class="form-control">
                </div>
                <div class="form-group my-3">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm-password" class="form-control">
                </div>
                
                <div class="form-group my-3">
                    <input class="btn btn-primary btn-large" type="submit" value="Update">
                </div>
                
            </div>
        </form>
    </div>
</div>
@endsection