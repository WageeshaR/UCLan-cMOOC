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
                    <i style="font-size: 32px; color: #346d3d" class="material-icons">home</i>
                    <span style="font-size: 20px; color: #346d3d; margin-left: 20px">Feed</span>
                </a>
                <a class="left-menu-item" id="profile">
                    <i style="font-size: 32px; color: #346d3d" class="material-icons">person</i>
                    <span style="font-size: 20px; color: #346d3d; margin-left: 20px">Profile</span>
                </a>
                <a class="left-menu-item" id="resources" href="{{ url('course-enroll/'.$course->course_slug.'/'.SiteHelpers::encrypt_decrypt($discussion->lecture_quiz_id).'/resources') }}">
                    <i style="font-size: 32px; color: #346d3d" class="material-icons">folder</i>
                    <span style="font-size: 20px; color: #346d3d; margin-left: 20px">Resources</span>
                </a>
                <a class="left-menu-item" id="account">
                    <i style="font-size: 32px; color: #346d3d" class="material-icons">account_balance</i>
                    <span style="font-size: 20px; color: #346d3d; margin-left: 20px">Account</span>
                </a>
                <a class="left-menu-item" id="settings">
                    <i style="font-size: 32px; color: #346d3d" class="material-icons">settings</i>
                    <span style="font-size: 20px; color: #346d3d; margin-left: 20px">Settings</span>
                </a>
                <a class="left-menu-item" id="settings">
                    <i style="font-size: 32px; color: #346d3d" class="material-icons">more</i>
                    <span style="font-size: 20px; color: #346d3d; margin-left: 20px">More</span>
                </a>
            </div>
            <div class="feed-scrollable-root">
                <?php
                    $tabs = array('pubs' => 'Publications',
                                  'data' => 'Research Data',
                                  'vids' => 'Video Footage',
                                  'quiz' => 'Quizzes',
                                  'othr' => 'Other');
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
                        <?php if ($tab_key == 'pubs') { ?>
                                <input class="res-search-input" placeholder="search by title" id="pubs-res-search-input" oninput="filter('pubs')">
                            </div>
                            @include('site.course.feed.resources.pubs', ['data' => $publications, 'course_id' => $course->id])
                        <?php } elseif ($tab_key == 'data') { ?>
                                <input class="res-search-input" placeholder="search by title" id="data-res-search-input" oninput="filter('data')">
                            </div>
                            @include('site.course.feed.resources.data', ['data' => $data, 'course_id' => $course->id])
                        <?php } elseif ($tab_key == 'quiz') { ?>
                                <input class="res-search-input" placeholder="search by title" id="quiz-res-search-input" oninput="filter('quiz')">
                            </div>
                            @include('site.course.feed.resources.quiz', ['data' => $quizzes, 'course_id' => $course->id])
                        <?php } elseif ($tab_key == 'vids') { ?>
                                <input class="res-search-input" placeholder="search by title" id="vids-res-search-input" oninput="filter('vids')">
                            </div>
                            @include('site.course.feed.resources.vids', ['data' => $video_footage, 'course_id' => $course->id])
                        <?php } else { ?>
                                <input class="res-search-input" placeholder="search by title" id="othr-res-search-input" oninput="filter('othr')">
                            </div>
                            @include('site.course.feed.resources.other', ['data' => $other, 'course_id' => $course->id])
                        <?php } ?>
                    </div>
                    <?php }?>
                </div>
            </div>
            @include('site.course.feed.feed-column-right', ['course' => $course, 'tw_content' => $tw_content, 'fb_contant' => $fb_content]);
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
        function loadData(res, course_slug, lecture_slug) {
            const xmlHttp = new XMLHttpRequest();
            const url = 'course-enroll/'+ course_slug + '/' + lecture_slug + '/resources/' + res;
            xmlHttp.open( "GET",url , false ); // false for synchronous request
            xmlHttp.send( null );
            const resource = JSON.parse(xmlHttp.response);
        }
        function filter(res) {
            const val = $("#"+res+"-res-search-input")[0].value;
            let collection = document.getElementsByClassName("resource_tab_item_vertical");
            for (element of collection) {
                const e = element;
                if (!e.querySelector("#title-tag").innerText.includes(val)) {
                    e.style.display = 'none';
                } else {
                    if (e.style.display == 'none') {
                        e.style.display = 'block';
                    }
                }
            };
        };

        function requestAccess(course_id,access_type) {
            const xmlHttp = new XMLHttpRequest();
            const url = '/resource-access-request/'+ course_id + '/' + access_type;
            xmlHttp.open( "GET",url , false ); // false for synchronous request
            xmlHttp.send( null );
            const res = JSON.parse(xmlHttp.response);
            let banner = $("#no-access-banner")[0];
            banner.innerHTML = "<h1>ACCESS REQUESTED<br></h1><span>You will receive an email once it is granted.</span>"
            return true;
        }
    </script>
@endsection