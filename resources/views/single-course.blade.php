@extends('layouts.frontend')

@section('body')
        @foreach($courses as $course)
            @include('partials/course/page-banner')    
            @include('partials/course/single-course')     
        @endforeach  
@endsection