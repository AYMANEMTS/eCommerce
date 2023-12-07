@extends('layouts.app')
@section('links')
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection
@section('content')
    <div class="">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="">Add section for product</h1>
                </div>
                <form action="{{ route('section.store',$product->id) }}" method="post">
                    @csrf
                    <label for="">Name of section:</label>
                    <input type="text" class="form-control" name="name">
                    <label for="">Section:</label>
                    <textarea name="section" id="section" cols="30" rows="10"></textarea>
                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#section').summernote({
            placeholder: 'section...',
            tabsize:2,
            height:300
        });
    </script>
@endsection
