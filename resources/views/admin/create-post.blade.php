@extends('layouts.admin')

@section('body')

<div class="card">

    <div class="card-header">
        Create <strong>Post</strong>
    </div>

    <form action="/CreatePost" method="post" enctype="multipart/form-data">

        @csrf

        <div class="card-body card-block">

            <div class="form-group">
                <label>Post Featured Image</label>
                <input name="image" type="file" class="form-control" id="inputGroupFile02">
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Post Title</label>
                <input type="text" name="title"  class="form-control" />
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
                <textarea  class="form-control"  id="summary-ckeditor"  name="description"></textarea>
            </div>

        </div>

        <div class="card-footer">
            <input type="submit" class="btn btn-primary btn-large"/>                                              
        </div>

    </form>

    

</div>


@endsection