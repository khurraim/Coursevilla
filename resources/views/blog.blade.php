@extends('layouts.frontend')

@section('body')
<!--====== PAGE BANNER PART START ======-->
    
    @include('partials/blog/page-banner')
    
    <!--====== PAGE BANNER PART ENDS ======-->
   
    <!--====== BLOG PART START ======-->
    
    @include('partials/blog/blog-page')
    
    <!--====== BLOG PART ENDS ======-->
@endsection