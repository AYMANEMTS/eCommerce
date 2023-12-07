@extends('layouts.app')
@section('title', ($isUpdate?'Update':'Create').' product')
@php
    $route = route('products-e.store');
    if($isUpdate) {
       $route =  route('products-e.update', $product);
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
<form action="{{$route}}" method="post" enctype="multipart/form-data">
    @csrf
    @if($isUpdate)
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="name" class="form-label">Titile</label>
        <input type="text" name="title" id="title" class="form-control" value="{{old('name', $product->title)}}">
    </div>
    <div class="form-group">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description"
                  class="form-control">{{old('description', $product->description)}}</textarea>
    </div>
    <div class="form-group">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" id="quantity" class="form-control"
               value="{{old('quantity', $product->quantity)}}">
    </div>

    <div class="form-group">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control">
        @if($product)
            <img width="100px" src="/storage/{{$product->image}}" alt="">
        @endif
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.5" name="price" id="price" class="form-control"
                       value="{{old('price', $product->price)}}">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="befor_price" class="form-label">Befor Price</label>
                <input type="number" step="0.5" name="befor_price" id="befor_price" class="form-control"
                       value="{{old('befor_price', $product->befor_price)}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">Please choose your category</option>
                    @foreach($categories as $category)
                        <option @selected(old('category_id', $product->category_id) === $category->id) value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="payement_method" class="form-label">Payement method</label>
                <select name="payement_method" id="payement_method" class="form-select">
                    <option value="">Please choose your category</option>
                    <option value="cash" <?php if($product->payement_method == 'cash') echo 'selected'; ?>>Cash</option>
                    <option value="online" <?php if($product->payement_method == 'online') echo 'selected'; ?>>Online</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="other_images" class="form-label">Other Images</label>
            <input type="file" name="other_images[]" data-max-files="4" multiple class="form-control">
            <span>crl + click images for multi select (max:4 images) </span>
        </div>
    </div>
    <div style="margin-top: 8px">
        @if ($isUpdate)
            @foreach ($product->images as $image)
                <div style="display: inline-block; margin-right: 10px; position: relative;">
                    <img style="height: 100px" src="/storage/{{ $image->path }}" alt="Product Image">
                    <a href="{{route('deleteImage',['productId' => $product->id, 'imageId' => $image->id])}}" class="delete-button" style="position: absolute; top: 5px; right: 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ff0000}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                    </a>
                </div>
            @endforeach
        @endif
    </div>



    <div class="form-group my-3">
        <input type="submit" class="btn btn-primary w-100" value="{{$isUpdate?'Edit': 'Create'}}">
    </div>
</form>

@endsection
