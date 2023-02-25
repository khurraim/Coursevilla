@extends('layouts.teacher')

@section('body')
<p>This is a teacher panel</p>

@if(auth()->guard('teacher')->user()->payment_setup == 0)
<div class="container">
    <form method="POST" action="{{url('/stripe/connect')}}">
        @csrf
        <input class="btn btn-primary" type="submit">
    </form>
</div>
@endif
@endsection