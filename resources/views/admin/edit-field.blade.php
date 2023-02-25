@extends('layouts.admin')

@section('body')

<div class="card">
    
    <div class="card-header">
        Edit <strong>FAQ</strong>
    </div>

    @foreach($fields as $field)   

    <form action="/UpdateField/{{$field->id}}" method="post" class="">
            @csrf
            
    
    <div class="card-body card-block">

             

            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Name </label>
                <input type="text" id="nf-email" name="name" value="{{ $field->name }}"  class="form-control">
                
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Description</label>
               

                <input type="text" name="description" value="{{$field->description}}" class="form-control">
            </div>

        

    </div>
    
    <div class="card-footer">
        <input value="Update" type="submit" class="btn btn-primary btn-large"/>
            
                                                        
    </div>
    </form>

    @endforeach    

</div>

@endsection