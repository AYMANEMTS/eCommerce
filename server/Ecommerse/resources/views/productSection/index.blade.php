@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Section for this product ({{ $product->title }})</h1>
    <hr>
    <a class="btn btn-primary" href="{{ route('section.create',$product->id) }}" >Create section</a>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($product->sections as $section)
            <tr>
                <td>{{$section->id}}</td>
                <td>{{$section->nameOfSection}}</td>
                <td>
                    <a href="{{ route('section.show',$section->id) }}" class="btn btn-primary">Show</a>
                    <a href="{{ route('section.edit',$section->id) }}" class="btn btn-warning">Update</a>
                    <form method="post" action="{{ route('section.destroy',$section->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <td align="center" colspan="3">No section for this product</td>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
