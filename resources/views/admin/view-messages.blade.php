@extends('layouts.admin')

@section('body')

@if ($messages->isNotEmpty()) 
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">Basic Table</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Sender Name</th>
                        <th scope="col">Sender Email</th>
                        <th scope="col">Sender Subject</th>
                        <th scope="col">Sender Number</th>
                        <th scope="col">Sender Message</th>
                        <th scope="col">Date/Day</th>
                        
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($messages as $message)
                        <td>{{ $message->name }}</td>  
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->phone }}</td>
                        <td>{{ $message->body }}</td>
                        <td>{{ $message->created_at }}</td>
                        
                        <td>
                            <form action="/DeleteMessage/{{$message->id}}" method="POST">
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
    <h3 class="my-2 text-center">No Messages Found</h3>
@endif
@endsection