@extends('layouts.admin')

@section('body')
@if ($courses->isNotEmpty())    
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">All Courses</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Video</th>
                        <th scope="col">Tutor</th>
                        
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($courses as $course)
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->price }}</td>
                        
                        <td>
                            <form action="#" method="POST">
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
    <h3 class="my-2 text-center">No Courses Found</h3>
@endif
@endsection