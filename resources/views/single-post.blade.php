@extends('layouts.frontend')

@section('body')

<div class="container text-center">
    @foreach($posts as $post)
        <img src="{{ url('storage/images/post/'.$post->post_image) }}" alt="Blog">
        <h1 class=" my-5">{{$post->post_title}}</h1>
        <p style="text-align: justify;" class="mb-5 px-5">{{$post->post_description}}</p>
    @endforeach
    </div>

@endsection