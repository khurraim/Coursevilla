@extends('layouts.frontend')

@section('body')
    <div class="container p-5">
        <h1 class="text-center my-5">
            Frequently Asked Questions
        </h1>
        @foreach($faqs as $faq)
            <div class="mb-3">
                <button class="accordion">{{ $faq->question }}</button>
                <div class="panel">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>

        @endforeach
    </div>  
@endsection