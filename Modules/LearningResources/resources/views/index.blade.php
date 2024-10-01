@extends('learningresources::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('learningresources.name') !!}</p>
@endsection
