@extends('layouts.admin')

@section('body')
@if ($categories->isNotEmpty())    
<div class="col-lg-12">
    <div class="card">

        <div class="card-header">
            <strong class="card-title">All Categories</strong>
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Category Title</th>
                        <th scope="col">Category Description</th>
                        <th scope="col">Category Date/Day</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($categories as $category)
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_description }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <a href="/EditCategory/{{$category->id}}" class="btn btn-primary">Edit</a>     
                        </td>
                        <td>
                            <form action="/DeleteCategory/{{$category->id}}" method="POST">
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
    <h3 class="my-2 text-center">No Categories Found</h3>
@endif
@endsection