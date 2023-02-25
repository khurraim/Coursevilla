@extends('layouts.admin')

@section('body')
@if ($teachers->isNotEmpty())
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">View Teachers</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Teacher Name</th>
                        <th scope="col">Teacher Email</th>
                        <th scope="col">Teacher Image</th>
                        <th scope="col">Teacher Status</th>
                        <th scope="col">Teacher DOB</th>
                        <th scope="col">Teacher Field</th>
                        <th scope="col">Teacher Gender</th>
                        <th scope="col">Teacher Bio</th>
                        
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($teachers as $teacher)
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>
                            <img src="{{ url('storage/images/teacher/'.$teacher->image) }}" alt="No Image Found"/>                            
                        </td>
                        <td>{{ $teacher->approved }}</td>
                        <td>{{ $teacher->dob }}</td>
                        <td>{{ $teacher->field }}</td>
                        <td>{{ $teacher->gender }}</td>
                        <td>{{ $teacher->bio }}</td>
                        
                        <td>
                            <form action="/DeleteTeacher/{{$teacher->id}}" method="POST">
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
    <h3 class="my-2 text-center">No Teachers Found</h3>
@endif
@endsection

