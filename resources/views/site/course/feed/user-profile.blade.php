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
            <div class="user-profile-container" style="margin-top: 200px">
                <div class="user-profile-pic">
                    <img height="200px" src="@if(Storage::exists('user_resources/'.$user->id.'/profile_pic')){{ url('storage/user_resources/'.$post->author_id.'/profile_pic') }}@else{{ asset('frontend/img/avatar.png') }}@endif">
                </div>
                <div class="text-center">
                    <span style="font-size: 30px; font-weight: bolder">
                        {{ $user->first_name . ' ' . $user->last_name }}
                    </span>
                </div>
                <hr>
                <div style="width: 90%; margin-left: 5%">
                    <div class="row justify-content-between">
                        <h5 style="font-weight: bold">Institution:</h5>
                        <h5>{{ $user->institution }}</h5>
                    </div>
                    <div class="row justify-content-between">
                        <h5 style="font-weight: bold">Email:</h5>
                        <h5>{{ $user->email }}</h5>
                    </div>
                    <div class="row justify-content-between">
                        <h5 style="font-weight: bold">Contact no: </h5>
                    </div>
                    <div class="row justify-content-between">
                        <h5 style="font-weight: bold">Anonymize details: </h5>
                        <input style="margin-left: 5px; margin-bottom: 5px" id="anonymize-input" name="anonymize-input" type="checkbox" @if($user->anonymize) checked @endif onchange="anonymize(this)">
                    </div>
                </div>
            </div>

            <script>
                function anonymize(flag) {
                    fetch("/user/anonymize", {
                        method: "POST",
                        headers: {'Content-Type': 'application/json', "X-CSRF-Token": '{{csrf_token()}}'},
                        body: JSON.stringify({
                            anonymize: flag.checked
                        })
                    }).then(res => {
                        location.reload();
                    });
                }
            </script>
        <!--Feed UI end-->
        </div>
    </div>
@endsection