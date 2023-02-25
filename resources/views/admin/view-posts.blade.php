@extends('layouts.admin')

@section('body')
@if ($posts->isNotEmpty())   
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

                    @foreach($posts as $post)
                        <td>{{ $post->post_title }}</td>
                        <td>
                            <img src="{{ url('storage/images/post/'.$post->post_image) }}" alt="No Image Found"/>                            
                        </td>
                        <td>{{ $post->post_category }}</td>
                        <td>{{Str::limit($post->post_description, 100)}}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a class="text-white" href="/EditPost/{{$post->id}}">
                                <button class="btn btn-success">
                                    Edit
                                </button>
                            </a>
                        </td>
                        <td>
                            <form action="/DeletePost/{{$post->id}}" method="POST">
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
    <h3 class="my-2 text-center">No Posts Found</h3>
@endif
@endsection

