@extends('layouts.evaluator')

@section('body')

<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">Assigned Teachers</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Teacher Name</th>
                        <th scope="col">Teacher Email</th>
                        <th scope="col">Tacher Gender</th>
                        <th scope="col">Teacher CV</th>
                        <th scope="col">Teacher Bio</th>
                        <th scope="col">Date/Day</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($AssignedTeachers as $teacher)
                        <td>{{ $teacher->name }}</td>  
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->gender }}</td>
                        <td>
                            <img src="{{ url('storage/images/teacher/'.$teacher->image) }}"/>
                        </td>
                        <td>{{ $teacher->bio }}</td>
                        <td>{{ $teacher->created_at }}</td>
                       
                        <td>
                            <form action="/ApproveTeacher/{{$teacher->id}}" method="POST">
                                @csrf
                                
                                <input type="submit" class="btn btn-success" value="Approve"/>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    

                    


                </tbody>
            </table>
        </div>
    </div>
</div>
    

@endsection