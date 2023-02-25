@extends('layouts.admin')

@section('body')

<div class="card">
    
    <div class="card-header">
        Create <strong>Field</strong>
    </div>

    <form action="/SaveField" method="post" class="">
            @csrf
    
        <div class="card-body card-block">
            
                <div class="form-group">
                    <label for="nf-name" class=" form-control-label">Field Name: </label>
                    <input type="text" id="nf-email" name="name"  class="form-control">
                    
                </div>

                <div class="form-group">
                    <label for="nf-description" class=" form-control-label">Desciption</label>
                    <textarea  class="form-control" id="summary-ckeditor" name="description"></textarea>
                </div>

            
        </div>
    
    <div class="card-footer">
        <input type="submit" class="btn btn-primary btn-large"/>
            
                                                        
    </div>
    </form>

</div>

@endsection