@extends('layouts.admin')

@section('body')
@if ($students->isNotEmpty())   
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">Basic Table</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Post Title</th>
                        <th scope="col">Post Image</th>
                        <th scope="col">Post Category</th>
                        <th scope="col">Post Description</th>
                        <th scope="col">Post Date/Day</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($students as $student)
                        <td>{{ $student->name }}</td>
                        <td>
                            <img src="{{ url('storage/images/student/'.$student->image) }}" alt="No Image Found"/>                            
                        </td>
                        <td>{{ $student->student_category }}</td>
                        
                        <td>{{ $student->created_at }}</td>
                      
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
    <h3 class="my-2 text-center">No Students Found</h3>
@endif
@endsection

