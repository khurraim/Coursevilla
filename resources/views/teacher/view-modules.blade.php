@extends('layouts.teacher')

@section('body')
    
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">All Modules</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Video Link</th>
                        <th scope="col">Course Name</th>
                        
                        <th scope="col">Created At</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($modules as $module)
                       
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->short_description }}</td>
                        <td>
                        <video class="module" width="320" height="240" controls controlsList="nodownload">
                            <source  class="module" src="{{ $module->video_link }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        </td>
                        <td>{{ $module->course_title }}</td>
                        <td>{{ $module->created_at }}</td>
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