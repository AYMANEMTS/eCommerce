@extends('layouts.app')

@section('content')
    <h1>{{ $section->nameOfSection }}</h1>
    <div>
        {!! $section->section !!}
    </div>
@endsection
