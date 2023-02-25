@extends('layouts.frontend')

@section('body')

<div class="container d-flex justify-content-center">

        <div class="col-sm-10 col-lg-10 col-12">
    
        @foreach($posts as $post)
        
        <div class="card mb-5">
        <div class="singel-blog ">
                       <div class="blog-thum">
                           <img height="400" src="{{ url('storage/images/post/'.$post->post_image) }}" alt="Blog">
                       </div>
                       <div class="blog-cont">
                           <a href="#"><h3>{{$post->post_title}}</h3></a>
                           <ul>
                               <li><a href="#"><i class="fa fa-calendar"></i>{{$post->created_at}}</a></li>
                               
                               <li><a href="#"><i class="fa fa-tags"></i>{{$post->post_category}}</a></li>
                           </ul>
                           <p>{{Str::limit($post->post_description, 100)}}</p>
                           <button class="btn btn-dark mt-3" >
                            <a class="text-white" href="/Post/{{$post->id}}">Read More...</a> 
                           </button>
                       </div>
                   </div> 
                   </div>
        @endforeach
            </div>
        </div>   
@endsection