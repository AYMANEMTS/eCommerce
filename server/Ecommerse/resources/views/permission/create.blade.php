@extends('layouts.app')
@section('title','Users permission')


@section('content')
    <div class="d-flex bd-highlight">
        <div class="p-2 w-100 bd-highlight"><h1>User Permission </h1></div>
        <div class="p-2 flex-shrink-1 bd-highlight"><a href="{{ route('users.index') }}" class="btn btn-outline-info">Back</a></div>
    </div>
    <div class="container bg-white border-4 border-top border-primary ">
        <div class="container mt-3">
            <form method="post" action="{{ route('permissions.store',$userPerm->id) }}">
                @csrf
                <div id="products">
                    <h5>Product</h5>
                    <div class="form-check form-switch">
                        <input name="test" disabled  class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">View products</label>
                    </div>
                    <div class="form-check form-switch">
                        <input name="CRUD_product" @if($userPerm->hasPermision('CRUD_product')) checked @endif value="2" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">CRUD product</label>
                    </div>
                </div>
                <div id="category">
                    <h5>Category</h5>
                    <div class="form-check form-switch">
                        <input disabled class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">View category</label>
                    </div>
                    <div class="form-check form-switch">
                        <input name="CRUD_category" @if($userPerm->hasPermision('CRUD_category')) checked @endif value="1" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">CRUD category</label>
                    </div>
                </div>
                <div id="orders">
                    <h5>Orders</h5>
                    <div class="form-check form-switch">
                        <input name="VIEW_orders" @if($userPerm->hasPermision('VIEW_orders')) checked @endif value="6" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">View orders</label>
                    </div>
                    <div class="form-check form-switch">
                        <input name="EDIT_orders" @if($userPerm->hasPermision('EDIT_orders')) checked @endif value="7" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Edit orders</label>
                    </div>
                    <div class="form-check form-switch">
                        <input name="DELETE_orders" @if($userPerm->hasPermision('DELETE_orders')) checked @endif value="8" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Delete orders</label>
                    </div>
                </div>
                <div id="users">
                    <h5>Users</h5>
                    <div class="form-check form-switch">
                        <input name="VIEW_users" @if($userPerm->hasPermision('VIEW_users')) checked @endif value="5" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">View users</label>
                    </div>
                    <div class="form-check form-switch">
                        <input name="CREATE_users" @if($userPerm->hasPermision('CREATE_users')) checked @endif value="3" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Create users</label>
                    </div>
                    <div class="form-check form-switch">
                        <input name="DELETE_users" @if($userPerm->hasPermision('DELETE_users')) checked @endif value="4" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Delete users</label>
                    </div>
                </div>
                <div id="payment">
                    <h5>Payment</h5>
                    <div class="form-check form-switch">
                        <input name="VIEW_payments" @if($userPerm->hasPermision('VIEW_payments')) checked @endif value="9" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">View payment</label>
                    </div>
                    <div class="form-check form-switch">
                        <input name="CRUD_payment" @if($userPerm->hasPermision('CRUD_payment')) checked @endif value="10" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">CRUD payment</label>
                    </div>
                </div>
                <div id="permission">
                    <h5>Permission</h5>
                    <div class="form-check form-switch">
                        <input name="CRUD_permission" @if($userPerm->hasPermision('CRUD_permission')) checked @endif value="11" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">CRUD permission</label>
                    </div>
                </div>
                <div class="d-flex justify-content-end m-2">
                    <a class="btn btn-secondary mr-2 m-1" href="{{ route('users.index') }}">Cancel</a>
                    <button class="btn btn-primary m-1" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
