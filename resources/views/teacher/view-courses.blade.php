@extends('layouts.teacher')

@section('body')
    
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">All Courses</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Tutor</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Requirement</th>
                        <th scope="col">Scope</th>
                        <th scope="col">Date/Day</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($courses as $course)
                        <td>{{ $course->tutor_name }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->price }}</td>
                        <td>{{ $course->requirements }}</td>
                        <td>{{ $course->scope }}</td>
                        <td>{{ $course->created_at }}</td>
                        <td>
                            <input type="submit" class="btn btn-primary" value="Edit"/>
                        </td>
                        <td>    
                            <input type="submit" class="btn btn-danger" value="Delete"/>
                        </td>
                    </tr>
                    @endforeach
                    

                    


                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection