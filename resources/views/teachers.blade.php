@extends('layouts.frontend')

@section('body')

@if ($teachers->isNotEmpty()) 

    @include('partials/teachers/page-banner')
    
  
    
    @include('partials/teachers/teachers-page')

    @else
        <h1>No Teachers Found</h1>
    @endif

@endsection