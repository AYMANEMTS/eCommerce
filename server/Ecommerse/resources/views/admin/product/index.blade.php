@extends('layouts.app')
@section('title','Product List')


@section('content')


<div class="d-flex justify-content-between align-items-center">
    <h1>Product list </h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
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
        <th>Category</th>
        <th>Quantity</th>
        <th>Image</th>
        <th>Price</th>
        <th>Befor price</th>
        <th>Payement method</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->title}}</td>
            <td align="center">
                @if($product->category)
                    <a href="{{ route('category.show',$product->category) }}" class="btn btn-link">
                    <span class="badge bg-primary">
                    {{$product->category->name}}
                    </span>
                    </a>
                @endif
            </td>

            <td>{{$product->quantity}}</td>
            <td><img width="100px"  src="http://127.0.0.1:8000/storage/{{$product->image}}" alt=""></td>
            <td>{{$product->price}} MAD</td>
            <td>{{$product->befor_price}} MAD</td>
            <td>{{$product->payement_method}} </td>
            <td>
                <div class="btn-group gap-2">
                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary">Update</a>
                    <form method="post" action="{{ route('products.destroy',$product->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete"/>
                    </form>
                    <a href="{{ route('section.index',$product->id) }}" class="btn btn-secondary">section</a>

                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" align="center"><h6>No products.</h6></td>
        </tr>

    @endforelse
    </tbody>
</table>
{{$products->links()}}

@endsection


