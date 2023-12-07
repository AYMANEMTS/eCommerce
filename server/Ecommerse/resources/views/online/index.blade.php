@extends('layouts.app');

@section('content')
    <h1>List Payments :</h1>
<div id="paymentTable">
    <input class="form-control search" placeholder="Search" />
    <button data-sort="productName" class="sort badge bg-secondary mt-1" >Sort by product name</button>
    <button data-sort="fullName" class="sort badge bg-secondary mt-1" >Sort by name</button>
    <button data-sort="phone" class="sort badge bg-secondary mt-1" >Sort by phone</button>
    <button data-sort="email" class="sort badge bg-secondary mt-1" >Sort by email</button>
    <button data-sort="address" class="sort badge bg-secondary mt-1" >Sort by address</button>



    <br>
    <table  class="table">
        <thead>
        <tr>
            <th >#ID</th>
            <th >Product</th>
            <th >Full name</th>
            <th >phone</th>
            <th >email</th>
            <th >address</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody class="list">
        @forelse($payments as $payment)
            <tr>
                <td>{{$payment->id}}</td>
                <td class="productName">
                    <img style="max-height: 100px" width="100px"  src="http://127.0.0.1:8000/storage/{{$payment->product->image}}" alt="">
                    <br>
                    <b class="productName">{{ $payment->product->title }}</b>
                </td>
                <td class="fullName">{{$payment->user_name}}</td>
                <td class="phone">{{$payment->user_phone}}</td>
                <td class="email">{{$payment->user_email}}</td>
                <td class="address"> {{$payment->user_address}} </td>
                <td>
                    <div class="btn-group gap-1">
                        @if(Auth::user()->hasPermision('CRUD_payment'))
                            <form method="post" action="{{ route('payments.destroy',$payment) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" align="center"><h6>No payments.</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
{{--    <ul class="pagination"></ul>--}}

</div>
@endsection
@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var paymentList = new List('paymentTable', {
                valueNames: ['productName','fullName', 'phone', 'email', 'address'],
                // page: 3,
                // pagination: true
            });
        });


    </script>
@endsection
