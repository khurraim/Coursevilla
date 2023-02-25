@extends('layouts.evaluator')

@section('body')

<div class="card">
    
    <div class="card-header">
        Send <strong>Email</strong>
    </div>

    <form action="/SendEmail" method="post" class="">
            @csrf
    
    <div class="card-body card-block">
        
            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Your Name :</label>
                <input type="text" id="nf-email" name="name" placeholder="Enter Name.." class="form-control">
            </div>

            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Your Subject :</label>
                <input type="text" id="nf-email" name="subject" placeholder="Enter Subject" class="form-control">
            </div>


            <div class="form-group">
                <label for="nf-name"  class=" form-control-label">Receiver Email :</label>
                <select  name="email" class="form-control">
                    @foreach($AssignedTeachersList as $teacher)
                        <option>{{$teacher->email}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Your Message :</label>
                <textarea name="body" class="form-control" id="summary-ckeditor" name="description"></textarea>
            </div>

        
    </div>
    
    <div class="card-footer">
        <input type="submit" class="btn btn-primary btn-large"/>
            
                                                        
    </div>
    </form>

</div>

@endsection