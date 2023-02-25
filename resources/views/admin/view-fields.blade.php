@extends('layouts.admin')

@section('body')

@if ($fields->isNotEmpty()) 
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">Basic Table</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Field Name</th>
                        <th scope="col">Field Description</th>
                        <th scope="col">Date/Day</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($fields as $field)
                        <td>{{ $field->name }}</td>  
                        <td>{{ $field->description }}</td>
                        <td>{{ $field->created_at }}</td>
                        <td>
                            <a class="text-white" href="/EditField/{{$field->id}}">
                                <button class="btn btn-success">
                                    Edit
                                </button>
                            </a>
                        </td>
                        <td>
                            <form action="/DeleteField/{{$field->id}}" method="POST">
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
    <h3 class="my-2 text-center">No Fields Found</h3>
@endif
@endsection