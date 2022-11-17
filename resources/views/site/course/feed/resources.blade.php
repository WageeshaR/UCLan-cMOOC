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
            <div class="feed-menu-left">
                <a class="left-menu-item" id="home" href="{{ url('course-enroll/'.$course->course_slug.'/'.SiteHelpers::encrypt_decrypt($discussion->lecture_quiz_id)) }}">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">home</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Feed</span>
                </a>
                <a class="left-menu-item" id="profile">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">person</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Profile</span>
                </a>
                <a class="left-menu-item" id="resources" href="{{ url('course-enroll/'.$course->course_slug.'/'.SiteHelpers::encrypt_decrypt($discussion->lecture_quiz_id).'/resources') }}">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">folder</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Resources</span>
                </a>
                <a class="left-menu-item" id="account">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">account_balance</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Account</span>
                </a>
                <a class="left-menu-item" id="settings">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">settings</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Settings</span>
                </a>
                <a class="left-menu-item" id="settings">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">more</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">More</span>
                </a>
            </div>
            <div class="feed-scrollable-root">
                <?php
                    $tabs = array('papers' => 'Publications',
                                  'data' => 'Research Data',
                                  'footages' => 'Visual Footages',
                                  'quizzes' => 'Quizzes',
                                  'other' => 'Other');
                ?>
                <nav class="clearfix secondary-nav seperator-head">
                    <ul class="secondary-nav-ul list mx-auto nav">
                        <?php foreach ($tabs as $tab_key => $tab_value) { ?>
                        <li class="nav-item">
                            <a data-toggle="tab" role="tab" href="<?php echo '#'.$tab_key;?>" class="nav-link <?php echo $tab_key == 'latestTab' ? 'active' : '';?>"><?php echo $tab_value;?></a>
                        </li>
                        <?php }?>
                    </ul>
                </nav>

                <div style="overflow-y: auto; height: 500px" class="container tab-content">
                    <?php foreach ($tabs as $tab_key => $tab_value) { ?>
                    <div class="<?php echo $tab_key == 'latestTab' ? 'tab-pane fade show active' : 'tab-pane fade';?>" id="<?php echo $tab_key;?>" role="tabpanel">
                        <div class="resource_search_bar">
                            <span style="font-weight: bold; color: lightgrey; font-size: 14px">search</span>
                            <i style="font-size: 26px; color: lightgrey" class="material-icons">search</i>
                        </div>
                        <?php if ($tab_key == 'papers') { ?>
                            @include('site.course.feed.resources.papers')
                        <?php } elseif ($tab_key == 'data') { ?>
                            @include('site.course.feed.resources.data')
                        <?php } elseif ($tab_key == 'data') { ?>
                            @include('site.course.feed.resources.data')
                        <?php } elseif ($tab_key == 'quizzes') { ?>
                            @include('site.course.feed.resources.quizzes')
                        <?php } else { ?>
                            @include('site.course.feed.resources.other')
                        <?php } ?>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="feed-menu-right">
                <span>More on <b>{{ $course->course_title }}</b></span>
                <div>
                    <div id="social-container">
                        <div>
                            <span id="twitter">Twitter</span>
                            <img src="{{asset('frontend/icons/Twitter.png')}}" height="27.5px" style="padding-bottom: 10px">
                        </div>
                        <div>
                            <span>popular within this course</span><br>
                            <a href="https://twitter.com/hashtag/disastermanagement?src=hashtag_click">#disastermanagement</a>
                            <a href="https://twitter.com/hashtag/disasterpreparedness?src=hashtag_click">#disasterpreparedness</a>
                            <a href="https://twitter.com/hashtag/EmergencyMedicine?src=hashtag_click">#EmergencyMedicine</a><br>
                            <div style="margin-top: 10px">Follow the <a style="font-weight: bold" href="www.twitter.com">course profile</a></div>
                        </div>
                    </div>
                    <div id="social-container">
                        <div>
                            <span id="facebook">Facebook</span>
                            <img src="{{asset('frontend/icons/Facebook.png')}}" height="27.5px" style="padding-bottom: 10px">
                        </div>
                        <div>
                            <div>
                                <span>Join active discussions on below communities</span><br>
                                <a style="font-weight: bold" href="www.facebook.com">Group 1</a><br>
                                <a style="font-weight: bold" href="www.facebook.com">Group 2</a><br>
                                <a style="font-weight: bold" href="www.facebook.com">Group 3</a><br>
                                <div style="margin-top: 10px">Follow the official <a style="font-weight: bold" href="www.facebook.com">course page</a></div>
                            </div>
                        </div>
                    </div>
                    <div id="social-container">
                        <div>
                            <div style="margin-top: 10px">For weekly up-to date information</div>
                            <button class="subscribe">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Feed UI end-->
        </div>
    </div>
@endsection
@section("javascript")
    <script>
        function openPopUp() {
            document.getElementById("discussion-popup").style.display = 'block';
        }
        function closePopUp() {
            document.getElementById("discussion-popup").style.display = 'none';
        }
        function openChat() {
            document.getElementById("chat-frame").style.display = 'block';
        }
        function closeChat() {
            document.getElementById("chat-frame").style.display = 'none';
        }
    </script>
@endsection