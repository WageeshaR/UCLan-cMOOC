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
            <div class="testing-ui-left">Left Side Menu</div>
            <div class="feed-scrollable-root">
                <div class="editor-frame">
                    <div class="editor-collapsed-container">
                        <button class="editor-create-button">Create</button>
                        <span class="grayed-out-text">new post</span>
                    </div>
                </div>
                <div class="published-post-frame">
                    <div class="post-header">
                        Wageesha Shilpage
                        <span style="font-weight: normal; font-size: 12px; color: rgb(216,216,216); margin-left: 5px">31 Oct &bull; Phuket, Thailand</span>
                    </div>
                    <div class="post-body">
                        <img src="{{asset('frontend/img/Sample image.jpg')}}" width="100%">
                        <div class="post-body-description">
                            Villages have adapted the design of houses to protect people from rising flood waters and small boats are used to transport people and food to sustain livelihoods.
                            This kind of disaster risk reduction is an important Climate change adaptation.
                        </div>
                    </div>
                    <div class="post-footer">
                        <span class="material-icons grayed-out-text">thumb_up</span>
                        <span class="material-icons grayed-out-text">comment</span>
                        <span class="material-icons grayed-out-text">share</span>
                        <span class="material-icons grayed-out-text">send</span>
                    </div>
                </div>
                <div class="published-post-frame">
                    <div class="post-header">
                        Wageesha Shilpage
                        <span style="font-weight: normal; font-size: 12px; color: rgb(216,216,216); margin-left: 5px">31 Oct &bull; Manchester, UK</span>
                    </div>
                    <div class="post-body">
                        <iframe width="100%" height="450" src="https://www.youtube.com/embed/oj5tbAFDQYA"></iframe>
                        <div class="post-body-description">
                            Villages have adapted the design of houses to protect people from rising flood waters and small boats are used to transport people and food to sustain livelihoods.
                            This kind of disaster risk reduction is an important Climate change adaptation.
                        </div>
                    </div>
                    <div class="post-footer">
                        <span class="material-icons grayed-out-text">thumb_up</span>
                        <span class="material-icons grayed-out-text">comment</span>
                        <span class="material-icons grayed-out-text">share</span>
                        <span class="material-icons grayed-out-text">send</span>
                    </div>
                </div>
            </div>
            <div class="testing-ui-right">Right Side Menu</div>
        </div>
    </div>
@endsection