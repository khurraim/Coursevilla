@extends('layouts.admin')

@section('body')

<div class="card">
    
    <div class="card-header">
        Create <strong>Category</strong>
    </div>

    <form action="/SaveCategory" method="post" class="">
            @csrf
    
    <div class="card-body card-block">
        
            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Category Title </label>
                <input type="text" id="nf-email" name="title" placeholder="Enter Title.." class="form-control">
                
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Category Description</label>
                <textarea name="description" class="form-control" id="summary-ckeditor" name="description"></textarea>
            </div>

        
    </div>
    
    <div class="card-footer">
        <input type="submit" class="btn btn-primary btn-large"/>
            
                                                        
    </div>
    </form>

</div>

@endsection