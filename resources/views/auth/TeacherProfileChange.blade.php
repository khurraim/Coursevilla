@extends('layouts.teacher')
@section('body')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center mt-3">Change Profile Details</h3>
        </div>
        @foreach($teachers as $teacher)
        <form enctype="multipart/form-data" method="POST" action="/UpdateTeacher/{{$teacher->id}}">
            @csrf
            <div class="container">
                <div class="form-group my-3">
                    <label for="">Profile Image</label>
                    <input type="file" class="form-control" name="image" id="">
                </div>
                <div class="form-group my-3">
                    <label for="">Name :</label>
                    <input name="name" type="text" value="{{$teacher->name}}"  class="form-control">
                </div>
                <div class="form-group my-3">
                    <label for="">Bio :</label>
                    <textarea name="bio" class="form-control" name=""  cols="30" rows="7">
                        {{$teacher->bio}}
                    </textarea>
                </div>
                <div class="form-group my-3">
                    <label for="">Field</label>
                    <select name="field" class="form-control">
                        @foreach($fields as $field)
                        <option name="field" value="{{$field->name}}">{{$field->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-3">
                    <input class="btn btn-primary btn-large" type="submit" value="Update">
                </div>
                
            </div>
        </form>
        @endforeach
    </div>
</div>


@endsection