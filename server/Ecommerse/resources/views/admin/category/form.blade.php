@extends('layouts.app')
@section('title', ($isUpdate?'Update':'Create').' category')
@php
    $route = route('category.store');
    if($isUpdate) {
       $route =  route('category.update', $category);
    }
@endphp

@section('content')

<h1>@yield('title'):</h1>
<hr>
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <strong>Errors</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{$route}}" method="post" >
    @csrf
    @if($isUpdate)
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{old('name', $category->name)}}">
    </div>
    <div class="form-group my-3">
        <input type="submit" class="btn btn-primary w-100" value="{{$isUpdate?'Edit': 'Create'}}">
    </div>
</form>

@endsection
