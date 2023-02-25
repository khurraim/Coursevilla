@extends('layouts.teacher')

@section('body')

<div class="card">
    
    <div class="card-header">
        Create <strong>Module</strong>
    </div>

    <form action="/SaveModule" id="module-form" method="post" enctype="multipart/form-data">
            @csrf
    
        <div class="card-body card-block">

            <div class="form-group">
                <label class="form-control-label">Select Course</label>
                <select name="course" class="form-control">
                    @foreach($courses as $course)
                    <option>{{$course->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Module Title </label>
                <input type="text" id="nf-email" name="name" placeholder="Enter Title.." class="form-control">  
            </div>


            <div class="form-group">
                <label  class="form-label">Video</label>
                <input type="file"  id="video-input" name="video" class="form-control">
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Module Description</label>
                <textarea  name="description" class="form-control" ></textarea>
            </div>
        
        </div>
    
        <div class="card-footer">
            <input type="submit"  class="btn btn-primary btn-large"/>                                                  
        </div>


    </form>

</div>



@endsection