@extends('layouts.frontend')
@section('body')

<div class="container p-5">
    <h1 class="text-center">Register As A Teacher</h1>
</div>

<div class="container">
    <form action="/SaveTeacher" class="w-50 d-block mx-auto my-5" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label class="form-label">Your Name : </label>
            <input type="text" name="name" class="form-control" placeholder="Enter Your Name Here...." />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Your Email : </label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email Here...." />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Your Password : </label>
            <input type="password" name="password" class="form-control" placeholder="Enter Your Password Here...." />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Your Date Of Birth : </label>
            <input type="date"  name="dob" class="form-control" />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Your Field : </label>
            <select class="form-control" name="field">
                @foreach($fields as $field)
                    <option>{{$field->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Your Gender : </label>
            <select class="form-control"  name="gender">
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Your CV : </label>
            <input type="file" name="image" />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Tell Us About Yourself : </label>
            <textarea class="form-control" name="bio"></textarea>
        </div>

        <div class="form-group mb-3">
            <input type="submit" class="btn btn-primary"/>
        </div>

    </form>
</div>
@endsection