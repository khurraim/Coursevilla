@extends('layouts.evaluator')

@section('body')
    
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
                    </tr>
                </thead>

                <tbody>

                    @foreach($evaluators as $evaluator)
                        <td>{{ $evaluator->name }}</td>
                        <td>{{ $evaluator->email }}</td>
                        <td>{{ $evaluator->field }}</td>
                        <td>{{ $evaluator->bio }}</td>
                        <td>{{ $evaluator->created_at }}</td>
                        
                        
                    </tr>
                    @endforeach
                    

                    


                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection