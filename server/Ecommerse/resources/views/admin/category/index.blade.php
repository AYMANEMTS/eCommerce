@extends('layouts.app')
@section('title','Categories List')
@section('content')


<div class="d-flex justify-content-between align-items-center">
    <h1>Categories list </h1>
    <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
</div>
@if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif
<table class="table">
    <thead>
    <tr>
        <th>#ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>
                <div class="btn-group gap-2">
                    <a href="{{ route('category.edit',$category) }}" class="btn btn-primary">Update</a>
                    <form method="post" action="{{ route('category.destroy',$category) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete"/>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" align="center"><h6>No Categories.</h6></td>
        </tr>

    @endforelse
    </tbody>
</table>
{{$categories->links()}}

@endsection


