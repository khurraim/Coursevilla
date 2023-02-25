@extends('layouts.admin')

@section('body')
<p>You are editing category</p>
@foreach($category as $cat)
    <p>$cat->created_at</p>
@endforeach
@endsection