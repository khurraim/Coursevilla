@extends('layouts.admin')

@section('body')

@if ($faqs->isNotEmpty()) 
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">All FAQs</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Question</th>
                        <th scope="col">Answer</th>
                        <th scope="col">Date/Day</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($faqs as $faq)
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>{{ $faq->created_at }}</td>
                        <td>
                            <a class="text-white" href="{{ url('EditFaq',$faq->id) }}">
                                <button class="btn btn-primary">
                                    Edit
                                </button>
                            </a>
                        </td>
                        <td>
                            <form action="/DeleteFAQ/{{$faq->id}}" method="POST">
                                @csrf
                                
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    

                    


                </tbody>
            </table>
        </div>
    </div>
</div>

@else   
    <h3 class="my-2 text-center">No FAQs Found</h3>
@endif
@endsection