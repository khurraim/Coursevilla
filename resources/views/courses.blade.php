@extends('layouts.frontend')
@section('body')
<!--====== PAGE BANNER PART START ======-->
    
<section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Our Courses</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Courses</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->
   
    <!--====== COURSES PART START ======-->
    
    <section id="courses-part" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="courses-top-search">
                        <ul class="nav float-left" id="myTab" role="tablist">
                            <li class="nav-item">Viewing All Courses</li>
                        </ul> <!-- nav -->
                        
                        <div class="courses-search float-right">
                            <form action="#">
                                <input type="text" placeholder="Search">
                                <button type="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div> <!-- courses search -->
                    </div> <!-- courses top search -->
                </div>
            </div> <!-- row -->
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" style="background: #EDF0F2 !important;" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                    <div class="row">

                        @foreach($courses as $course)
                        <div class="col-lg-4 col-md-6">
                            <div class="singel-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ url('storage/images/course/'.$course->image) }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>${{$course->price}}</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    
                                    
                                    <a href="courses-singel.html"><h4>{{$course->name}}</h4></a>
                                    <div class="course-teacher">
                                        <div class="name">
                                            <a class="mb-3" ><h6>By : {{$course->tutor_name}}</h6></a>
                                        </div>
                                    </div>

                                    <button class="btn btn-block btn-primary">
                                        <a class="text-white" href="/PreviewCourse/{{$course->id}}"> Preview Course</a>
                                    </button>
                                </div>
                            </div> <!-- singel course -->

                            
                        </div>
                        @endforeach
                    </div> <!-- row -->
                </div>
                
            </div> <!-- tab content -->
          <!-- row -->
        </div> <!-- container -->
    </section>
    <!--====== COURSES PART ENDS ======-->
   @endsection