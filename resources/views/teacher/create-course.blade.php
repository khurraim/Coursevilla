@extends('layouts.teacher')

@section('body')

<div class="card">
    
    <div class="card-header">
        Create <strong>Course</strong>
    </div>

    <form action="/SaveCourse" id="course-form" method="post" enctype="multipart/form-data">
            @csrf
    
        <div class="card-body card-block">
        
            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Course Title </label>
                <input type="text" id="nf-email" name="name" placeholder="Enter Title.." class="form-control">  
            </div>


            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Course Price</label>
                <input type="number" name="price" class="form-control" placeholder="Enter price in USD"/>
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Course Preview Image</label>
                <input type="file" name="image" class="form-control" placeholder="Upload Your Thumbnail"/>
            </div>

            <div class="form-group">
                <label  class="form-label">Preview Video</label>
                <input type="file" name="preview_video" class="form-control">
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Scope Of This Course</label>
                <textarea name="scope" class="form-control" ></textarea>
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Course Requirements</label>
                <textarea name="requirements" class="form-control" ></textarea>
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Course Description</label>
                <textarea name="description" class="form-control"  name="description"></textarea>
            </div>

        
        </div>
    
    <div class="card-footer">
        <input type="submit" class="btn btn-primary btn-large"/>                                                   
    </div>
    
    </form>

</div>

@endsection