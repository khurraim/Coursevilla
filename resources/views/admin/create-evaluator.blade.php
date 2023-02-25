@extends('layouts.admin')

@section('body')

<div class="card">
    
    <div class="card-header">
        Create <strong>Evaluator</strong>
    </div>

    <form action="/SaveEvaluator" method="post" class="">
            @csrf
    
    <div class="card-body card-block">
        
            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Evaluator Name :</label>
                <input type="text" id="nf-email" name="name" placeholder="Enter Name.." class="form-control">
            </div>

            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Evaluator Email :</label>
                <input type="email" id="nf-email" name="email" placeholder="Enter Email.." class="form-control">
            </div>

            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Evaluator Password :</label>
                <input type="password" id="nf-email" name="password" placeholder="Enter Password.." class="form-control">
            </div>

            <div class="form-group">
                <label for="nf-name"  class=" form-control-label">Evaluator Field :</label>
                <select  name="field" class="form-control">
                    @foreach($fields as $field)
                        <option>{{$field->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Evaluator Bio</label>
                <textarea name="bio" class="form-control" id="summary-ckeditor" name="description"></textarea>
            </div>

        
    </div>
    
    <div class="card-footer">
        <input type="submit" class="btn btn-primary btn-large"/>
            
                                                        
    </div>
    </form>

</div>

@endsection