@extends('layouts.app')
@section('title','Categories List')
@section('content')

editor
<div class="d-flex justify-content-between align-items-center">
    <h1>Categories list </h1>
    @if(Auth::user()->hasPermision('CRUD_category'))
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create</a>
    @endif
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
                @if(Auth::user()->hasPermision('CRUD_category'))
                    <div class="btn-group gap-2">
                    <a href="{{ route('categories.edit',$category) }}" class="btn btn-primary">Update</a>
                    <form method="post" action="{{ route('categories.destroy',$category) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete"/>
                    </form>
                </div>
                @else
                    <a class="btn btn-primary">Product items</a>
                @endif
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


