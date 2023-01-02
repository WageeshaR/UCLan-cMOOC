@extends('layouts.backend.index')
@section('content')

    <div class="page-content">
        <h1>{{ $content->blog_title }}</h1>
        <div>{!! $content->description !!}</div>
    </div>

@endsection