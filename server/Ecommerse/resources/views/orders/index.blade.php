@extends('layouts.app')

@section('content')
    <h1>List ordering for products :</h1>

    <div id="orderTable">
        <input class="form-control search" placeholder="Search" />
        <button data-sort="productName" class="sort badge bg-secondary mt-1" >Sort by product name</button>
        <button data-sort="fullName" class="sort badge bg-secondary mt-1" >Sort by name</button>
        <button data-sort="phone" class="sort badge bg-secondary mt-1" >Sort by phone</button>
        <button data-sort="email" class="sort badge bg-secondary mt-1" >Sort by email</button>
        <button data-sort="address" class="sort badge bg-secondary mt-1" >Sort by address</button>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Product</th>
                <th>Name</th>
                <th>phone</th>
                <th>email</th>
                <th>address</th>
                <th>status</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody class="list">
            @forelse($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>
                        <img style="max-height: 100px" width="100px"  src="http://127.0.0.1:8000/storage/{{$order->product->image}}" alt="">
                        <br>
                        <b class="productName">{{ $order->product->title }}</b>
                    </td>
                    <td class="fullName">{{$order->fullName}}</td>
                    <td class="phone">{{$order->phone}}</td>
                    <td class="email">{{$order->email}}</td>
                    <td class="address">{{$order->address}} </td>
                    <td>
                        @if($order->status === 'fresh')
                            <span class="badge bg-warning text-black">Fresh</span>
                        @elseif($order->status === 'checked')
                            <span class="badge bg-success text-white">Checked</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group gap-1">
                            @if($order->status === 'fresh')
                                <div class="btn-group">
                                    @if(Auth::user()->hasPermision('EDIT_orders'))
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><b class="dropdown-item ">status : </b></li>
                                            @if(Auth::user()->hasPermision('EDIT_orders'))
                                                <li>
                                                    <form method="post" action="{{ route('orders.changeStatus',$order->id) }}">
                                                        @csrf
                                                        <button class="dropdown-item bg-success text-white " >Checked</button>
                                                    </form>
                                                </li>
                                            @endif
                                            @if(Auth::user()->hasPermision('DELETE_orders'))
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form method="post" action="{{ route('orders.destroy',$order->id) }}">
                                                        @csrf
                                                        <button style="border-radius: 40px" type="submit"  class="dropdown-item bg-danger" >
                                                            <span style="margin-left: 50px;color: white">Delete</span>
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                            @elseif($order->status === 'checked' && Auth::user()->hasPermision('DELETE_orders'))
                                <form method="post" action="{{ route('orders.destroy',$order->id)}}">
                                    @csrf
                                    <button style="border-radius: 40px" type="submit"  class="btn btn-danger" >Delete</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" align="center"><h6>No orders.</h6></td>
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
            var paymentList = new List('orderTable', {
                valueNames: ['productName','fullName', 'phone', 'email', 'address'],
                // page: 3,
                // pagination: true
            });
        });
    </script>
@endsection
