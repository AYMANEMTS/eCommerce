@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="http://127.0.0.1:8000/storage/{{$product->image}}" class="img-fluid" alt="Image 1" />
                <div class="row">
                    <div class="col-md-3">
                        <img src="http://127.0.0.1:8000/storage/{{$product->image}}" class="img-fluid" alt="Image 1" />
                    </div>
                    <div class="col-md-3">
                        <img src="http://127.0.0.1:8000/storage/{{$product->image}}" class="img-fluid" alt="Image 1" />
                    </div>
                    <div class="col-md-3">
                        <img src="http://127.0.0.1:8000/storage/{{$product->image}}" class="img-fluid" alt="Image 1" />
                    </div>
                    <div class="col-md-3">
                        <img src="http://127.0.0.1:8000/storage/{{$product->image}}" class="img-fluid" alt="Image 1" />
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h1>{{ $product->title }}</h1>
                <b>Category <span class="badge badge-primary bg-primary">{{$product->category->name}}</span></b>
                <br>
                <b>price <span>${{ $product->price }} <del>(${{$product->befor_price}})</del></span></b>
                <br>
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
    <div class="container my-2">
            <a class="btn btn-primary" href="{{ route('section.create',$product->id) }}" >
                add section
            </a>
        <br>
        <div class="mt-3">
            @foreach($product->sections as $sec)
                {!! $sec->section !!}
            @endforeach
        </div>

    </div>
@endsection
