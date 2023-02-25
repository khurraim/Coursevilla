@extends('layouts.admin')

@section('body')
@if ($evaluators->isNotEmpty()) 
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">All Evalutors</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Field</th>
                        <th scope="col">Bio</th>
                        <th scope="col">Date/Day</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($evaluators as $evaluator)
                        <td>{{ $evaluator->name }}</td>
                        <td>{{ $evaluator->email }}</td>
                        <td>{{ $evaluator->field }}</td>
                        <td>{{ $evaluator->bio }}</td>
                        <td>{{ $evaluator->created_at }}</td>
                        <td>
                            <a class="text-white" href="#">
                                <button class="btn btn-success">
                                    Edit
                                </button>
                            </a>
                        </td>
                        <td>
                            <form action="/DeleteEvaluator/{{$evaluator->id}}" method="POST">
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
    <h3 class="my-2 text-center">No Evaluators Found</h3>
@endif
@endsection