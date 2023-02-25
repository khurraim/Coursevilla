@extends('layouts.admin')

@section('body')

<div class="card">
    
    <div class="card-header">
        Create <strong>FAQ</strong>
    </div>

    <form action="/SaveFAQ" method="post" class="">
            @csrf
    
    <div class="card-body card-block">
        
            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Question </label>
                <input type="text" id="nf-email" name="question"  class="form-control">
                
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Answer</label>
                <textarea name="answer" class="form-control" id="summary-ckeditor" name="description"></textarea>
            </div>

        
    </div>
    
    <div class="card-footer">
        <input type="submit" class="btn btn-primary btn-large"/>
            
                                                        
    </div>
    </form>

</div>

@endsection