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
                <div class="left-menu-item" id="profile">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">person</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Profile</span>
                </div>
                <div class="left-menu-item" id="resources">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">folder</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Resources</span>
                </div>
                <div class="left-menu-item" id="account">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">account_balance</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Account</span>
                </div>
                <div class="left-menu-item" id="settings">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">settings</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">Settings</span>
                </div>
                <div class="left-menu-item" id="settings">
                    <i style="font-size: 32px; color: rgb(40,50,140)" class="material-icons">more</i>
                    <span style="font-size: 20px; color: rgb(40,50,140); margin-left: 20px">More</span>
                </div>
            </div>
            <div class="feed-scrollable-root">
                <div class="editor-frame">
                    <div class="editor-expanded-container">
                        <div class="editor-body">
                            <span style="font-weight: bold; font-size: 16px; color: rgb(216,216,216)">Share your ideas..</span>
                        </div>
                        <div class="editor-footer">
                            <button class="editor-create-button">Post</button>
                            <i class="material-icons icon-hover" style="font-size: 28px; padding-left: 5px; color: rgb(216,216,216)">image</i>
                            <i class="material-icons icon-hover" style="font-size: 28px; padding-left: 5px; color: rgb(216,216,216)">ondemand_video</i>
                            <i class="material-icons icon-hover" style="font-size: 26px; color: rgb(216,216,216)">attach_file</i>
                        </div>
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
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </div>
                    </div>
                    <div class="post-footer">
                        <span title="make trending" class="material-icons colored-icon">trending_up</span>
                        <span onclick="openPopUp()" id="discussion" title="discussion" class="material-icons grayed-out-icon">comment</span>
                        <span title="share" class="material-icons grayed-out-icon">share</span>
                        <span onclick="openChat()" title="send to a chat" class="material-icons grayed-out-icon">send</span>
                    </div>
                </div>
                <div class="published-post-frame">
                    <div class="post-header tweet-share">
                        Wageesha Shilpage <span style="font-weight: normal">shared a </span> tweet
                        <span style="font-weight: normal; font-size: 12px; color: rgb(216,216,216); margin-left: 5px">31 Oct &bull; Bolton, UK</span>
                    </div>
                    <div class="tweet-share-body">
                        <a id="tweet-thumbnail" href="https://www.twitter.com">
                            <img src="{{asset('frontend/img/sample_disaster.jpg')}}" height="100%">
                        </a>
                        <div id="tweet-text">
                            <a style="display: block" href="https://www.twitter.com">
                                <span style="font-weight: bold; font-size: 16px">Sarah Flynn wrote:</span>
                            </a>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                It was popularised...
                            </p>
                        </div>
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
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </div>
                    </div>
                    <div class="post-footer">
                        <span title="make trending" class="material-icons grayed-out-icon">trending_up</span>
                        <span onclick="openPopUp()" id="discussion" title="discussion" class="material-icons grayed-out-icon">comment</span>
                        <span title="share" class="material-icons grayed-out-icon">share</span>
                        <span onclick="openChat()" title="send to a chat" class="material-icons grayed-out-icon">send</span>
                    </div>
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
                            <a href="www.twitter.com">#hashtag_1</a>
                            <a href="www.twitter.com">#hashtag_2</a>
                            <a href="www.twitter.com">#hashtag_3</a><br>
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

            <!--Sample demo popup start-->
            <div id="discussion-popup" class="discussion-popup-frame">
                <div style="margin-top: 0px">
                    <button onclick="closePopUp()" class="popup-close-button">close</button>
                </div>
                <div class="discussion-popup-message-box" style="margin-top: 10px">
                    <span>Sarah Flynn:</span>
                    <span style="font-weight: normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
                    <br>
                    <span style="font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px">reply</span>
                </div>
                <div class="discussion-popup-reply-box">
                    <span>Sarah Flynn:</span>
                    <span style="font-weight: normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                </div>
                <div class="discussion-popup-reply-box">
                    <span>Sarah Flynn:</span>
                    <span style="font-weight: normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
                </div>
                <div class="discussion-popup-reply-box">
                    <span>Sarah Flynn:</span>
                    <span style="font-weight: normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                </div>
                <div class="discussion-popup-message-box">Sarah Flynn:
                    <br>
                    <span style="font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px">reply</span>
                </div>
                <div class="discussion-popup-message-box">Sarah Flynn:
                    <br>
                    <span style="font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px">reply</span>
                </div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-message-box">Sarah Flynn:
                    <br>
                    <span style="font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px">reply</span>
                </div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-message-box">Sarah Flynn:
                    <br>
                    <span style="font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px">reply</span>
                </div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-reply-box">Sarah Flynn:</div>
                <div class="discussion-popup-message-box">Sarah Flynn:
                    <br>
                    <span style="font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px">reply</span>
                </div>
                <div class="discussion-popup-message-box">Sarah Flynn:
                    <br>
                    <span style="font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px">reply</span>
                </div>
                <div class="discussion-popup-message-box">Sarah Flynn:
                    <br>
                    <span style="font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px">reply</span>
                </div>
            </div>
            <!--Sample demo popup end-->

            <!--Sample chat popup start-->
            <div id="chat-frame" class="chat-frame">
                <div class="chat-name-bar">
                    <span class="material-icons grayed-out-icon">person</span>
                    <span style="font-weight: bold; margin-left: 5px; color: black; font-size: 12px; margin-top: 2px">Angela Yu</span>
                    <span onclick="closeChat()" style="margin-left: 130px" class="material-icons grayed-out-icon" >close</span>
                </div>
                <div class="chat-search-bar">search for a name</div>
                <div class="chat-type-bar"><i>type your message</i>...</div>
            </div>
            <!--Sample chat popup end-->
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