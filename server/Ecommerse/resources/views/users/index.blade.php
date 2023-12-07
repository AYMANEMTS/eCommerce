@extends('layouts.app')
@section('title','Users')


@section('content')


    <div class="d-flex justify-content-between align-items-center">
        <h1>Users :  </h1>
        @if(Auth::user()->hasPermision('CREATE_users'))
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add user</a>
        @endif
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif

    <div id="usersTable">
        <input class="form-control search" placeholder="Search" />
        <button data-sort="fullName" class="sort badge bg-secondary mt-1" >Sort by name</button>
        <button data-sort="email" class="sort badge bg-secondary mt-1" >Sort by email</button>
        <button data-sort="role" class="sort badge bg-secondary mt-1" >Sort by role</button>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>email</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="list">
            @forelse($users as $user)
                <tr>
                    <td >{{$user->id}}</td>
                    <td class="fullName">{{$user->name}}</td>
                    <td class="email">{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td class="role">{{$user->role}} </td>
                    <td>
                        <div class="btn-group gap-2">
                            @if(Auth::user()->hasPermision('CRUD_permission'))
                                <a href="{{ route('permissions.create',$user->id) }}" class="btn btn-secondary">Permission</a>
                            @endif
                            @if(Auth::user()->hasPermision('CREATE_users'))
                                <a href="{{ route('users.edit' , $user) }}" class="btn btn-primary">Update</a>
                            @endif
                            @if(Auth::user()->hasPermision('DELETE_users'))
                                <form method="post" action="users/{{$user->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete"/>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" align="center"><h6>No user.</h6></td>
                </tr>

            @endforelse
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var paymentList = new List('usersTable', {
                valueNames: ['fullName', 'email', 'role'],
                // page: 3,
                // pagination: true
            });
        });


    </script>
@endsection


