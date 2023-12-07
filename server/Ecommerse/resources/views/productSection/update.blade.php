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
    <div class="container p-4 ">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="text-center">
                </div>
                <h1 class="">Update section</h1>
                <form action="{{ route('section.update',$section->id) }}" method="post">
                    @csrf
                    <label for="">Title:</label>
                    <input type="text" class="form-control" name="name" value="{{ $section->nameOfSection }}">
                    <label for="">Description:</label>
                    <textarea name="section" id="section">
                        {{ $section->section }}
                    </textarea>

                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#section').summernote({
                placeholder: 'section...',
                tabsize: 2,
                height: 300,
            });
        });
    </script>
@endsection

