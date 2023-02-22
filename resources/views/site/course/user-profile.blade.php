@extends('layouts.frontend.index')
@section('content')
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/rating/rateyo.css') }}">

    <!-- content start -->
    <div class="container-fluid p-0 home-content">
        <!-- banner start -->
        <div class="subpage-slide-blue">
            <div class="container">
                <h1>Course</h1>
            </div>
        </div>
        <!-- banner end -->

        <!-- breadcrumb start -->
        <div class="breadcrumb-container">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('my.courses') }}">My Courses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $course->course_title }}</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- feed ui start -->
        <div class="feed-root-container">
            @include('site.course.feed.feed-column-left', ['course' => $course, 'discussion' => $discussion]);
            <div class="feed-scrollable-root">
                <div class="user-profile-container">
                    <div class="text-center">
                        <img height="200px" src="@if(Storage::exists($user->profile_image)){{ url('storage/'.$user->profile_image) }}@else{{ asset('frontend/img/avatar.png') }}@endif">
                    </div>
                    <div class="text-center">
                        <span style="font-size: 30px; font-weight: bolder">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-7"><h5>Institution: {{ $user->institution }}</h5></div>
                        <div class="col-md-5">
                            <div class="float-right"><h5>Email: {{ $user->email }}</h5></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><h5>Contact no: </h5></div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </div>
            <!--Feed UI end-->

        </div>
    </div>
@endsection
@section("javascript")

@endsection