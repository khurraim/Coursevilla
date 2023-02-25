@extends('layouts.frontend')
@section('body')
<!--====== PAGE BANNER PART START ======-->
    
    @include('partials/about/page-banner')
    
    <!--====== PAGE BANNER PART ENDS ======-->
   
    <!--====== ABOUT PART START ======-->
    
    @include('partials/about/about-part')
    
    <!--====== ABOUT PART ENDS ======-->

    <!--====== COUNTER PART START ======-->
    
    @include('partials/about/counter')
    
    <!--====== COUNTER PART ENDS ======-->
   
    <!--====== TEACHERS PART START ======-->
    
    @include('partials/about/teachers-part')
    
    <!--====== TEACHERS PART ENDS ======-->
   
    <!--====== TEASTIMONIAL PART START ======-->
    
    @include('partials/about/testimonial')
    
    <!--====== TEASTIMONIAL PART ENDS ======-->
   
    
@endsection