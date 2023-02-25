@extends('layouts.admin')

@section('body')

<div class="card">
    
    <div class="card-header">
        Edit <strong>FAQ</strong>
    </div>

    @foreach($faqs as $faq)   

    <form action="/UpdateFaq/{{$faq->id}}" method="post" class="">
            @csrf
            
    
    <div class="card-body card-block">

             

            <div class="form-group">
                <label for="nf-name" class=" form-control-label">Question </label>
                <input type="text" id="nf-email" name="question" value="{{ $faq->question }}"  class="form-control">
                
            </div>

            <div class="form-group">
                <label for="nf-description" class=" form-control-label">Answer</label>
               

                <input type="text" name="answer" value="{{$faq->answer}}" class="form-control">
            </div>

        

    </div>
    
    <div class="card-footer">
        <input value="Update" type="submit" class="btn btn-primary btn-large"/>
            
                                                        
    </div>
    </form>

    @endforeach    

</div>

@endsection