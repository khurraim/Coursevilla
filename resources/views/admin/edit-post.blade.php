@extends('layouts.admin')

@section('body')

<div class="card">

    <div class="card-header">
        Edit <strong>Post</strong>
    </div>

    @foreach($posts as $post)
    <form action="/UpdatePost/{{$post->id}}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="card-body card-block">

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Post Image</label>
                <input type="file" name="image"  class="form-control" />
            </div>


            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Post Title</label>
                <input type="text" name="title" value="{{$post->post_title}}"  class="form-control" />
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Post Category</label>
                <select name="category" class="form-control">
                    @foreach($categories as $category)
                        <option>{{ $category->category_name }}</option>
                    @endforeach        
                </select>
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Desciption</label>
                <textarea  class="form-control"  name="description">
                    {{$post->post_description}}
                </textarea>
            </div>

        </div>

        <div class="card-footer">
            <input type="submit" class="btn btn-primary btn-large"/>                                              
        </div>

        

    </form>

    @endforeach

</div>


@endsection