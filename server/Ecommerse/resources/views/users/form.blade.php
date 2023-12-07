@extends('layouts.app')
@section('title', ($isUpdate?'Update':'Create').' user')
@php
    $route = route('users.store');
    if($isUpdate) {
       $route =  route('users.update', $user);
    }
@endphp

@section('content')

    <h1>@yield('title'):</h1>
    <hr>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
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
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                           value="{{old('name', $user->name)}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="{{old('email', $user->email)}}">
                </div>
            </div>
        </div>
        @if(!$isUpdate)
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control " name="password">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input id="password_confirmation" type="password" class="form-control " name="password_confirmation">
                    </div>
                </div>
            </div>
        @endif
        <div class="form-group my-3">
            <input type="submit" class="btn btn-primary w-100" value="{{$isUpdate?'Edit': 'Create'}}">
        </div>
    </form>

@endsection
