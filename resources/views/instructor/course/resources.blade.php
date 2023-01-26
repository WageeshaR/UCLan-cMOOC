@extends('layouts.backend.index')
@section('content')
    @include('instructor.course.header')
    <div class="page-content">
        <div class="panel">
            <div class="panel-body">
                @include('instructor.course.tabs')
                <h4>Publications</h4>
                <hr>
                <h4>Research data</h4>
                <hr>
                <h4>Quizzes</h4>
                <hr>
                <h4>Video footage</h4>
                <hr>
                <h4>Other resources</h4>
                <hr>
            </div>
        </div>
    </div>
@endsection