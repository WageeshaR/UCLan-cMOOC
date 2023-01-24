@extends('layouts.frontend.index')
@section('content')
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/rating/rateyo.css') }}">
    <!-- Quill Editor -->
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
    <script src="https://unpkg.com/quill-image-compress@1.2.11/dist/quill.imageCompressor.min.js"></script>
    <!-- Twitter Widgets -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

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
                <form name="post-form" id="post-form" method="post" action="{{url('save-post')}}">
                    @csrf
                    <input type="hidden" id="course" name="course" class="form-control" required="" value="{{$course->course_slug}}">
                    <input type="hidden" id="lecture" name="lecture" class="form-control" required="" value="{{$discussion->lecture_quiz_id}}">
                    <input type="hidden" id="quill_content" name="quill_content">
                    <input type="hidden" id="post_id" name="post_id">
                    <div class="form-group">
                        <div id="contents"></div>
                        <input placeholder="tweet url" type="hidden" id="tweet_content" name="tweet_content" class="form-control">
                        <input placeholder="video url" type="hidden" id="yt_content" name="yt_content" class="form-control">
                    </div>
                    <div class="post-button-group">
                        <button type="submit" class="btn btn-primary" style="height: 35px">Post</button>
                        <img src="{{asset('frontend/icons/textbox.jpg')}}" height="40px" class="post-clickable-icon" onclick="openContents()">
                        <img src="{{asset('frontend/icons/Twitter.png')}}" height="40px" class="post-clickable-icon" onclick="openTweet()">
                        <img src="{{asset('frontend/icons/YT.png')}}" height="40px" class="post-clickable-icon" onclick="openYT()">
                    </div>
                </form>
                @foreach($posts as $post)
                    <div class="published-post-frame" id="{{$post->id}}">
                        <div class="post-header">
                            <div>
                                {{$post->author_id}}
                                <span style="font-weight: normal; font-size: 12px; color: rgb(200,200,200); margin-left: 5px">@Sample University Name &bull; 31 Oct &bull; {{$post->location}}</span>
                            </div>
                            <div class="dropdown">
                                <span title="edit post" class="material-icons grayed-out-icon" onclick="showEditOptions({{$post->id}})">more_vert</span>
                                <div class="dropdown-content" id="edit-dropdown-{{$post->id}}">
                                    <a href="#" onclick="editPost({{$post->id}})">Edit</a>
                                    <a href="#" onclick="deletePost({{$post->id}})">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="post-body" id="post-body" name="post-body">
                        @if($post->image_src)
                            <img src="{{asset($post->image_src)}}" width="100%">
                        @elseif($post->video_url)
                            <iframe width="100%" height="450" src="{{$post->video_url}}"></iframe>
                        @elseif($post->tweet_url)
                            <div class="tweet-body">
                                <blockquote class="twitter-tweet">
                                    <a href="{{$post->tweet_url}}"></a>
                                </blockquote>
                            </div>
                        @endif
                        @if(!is_null($post->content))
                            <div class="post-body-description">
                                {!! $post->content !!}
                            </div>
                        @endif
                        </div>
                        <div class="post-footer">
                            <span title="make trending" class="material-icons colored-icon">trending_up</span>
                            <span onclick="loadReloadPopUp({{$post->id}})" id="discussion" title="discussion" class="material-icons grayed-out-icon">comment</span>
                            <span title="share" class="material-icons grayed-out-icon">share</span>
                            <span onclick="openChat()" title="send to a chat" class="material-icons grayed-out-icon">send</span>
                        </div>
                        <div class="popup-backdrop" id="popup-backdrop-{{$post->id}}" onclick="closePopUp({{$post->id}})">
                            <div id="discussion-popup-{{$post->id}}" class="discussion-popup-frame">
                                <div style="margin-top: 0px">
                                    <button onclick="closePopUp({{$post->id}})" class="popup-close-button">close</button>
                                </div>
                                <div id="comment-container" class="comment-container">
                                    <input type="text" placeholder="what are your thoughts.." id="comment_box_{{$post->id}}" name="comment_box_{{$post->id}}" class="comment-box">
                                    <button onclick="submitComment({{$post->id}})" class="comment-button">comment</button>
                                </div>
                                <div id="discussion-body-{{$post->id}}"></div>
                            </div>
                        </div>

                    </div>
                @endforeach
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
                            <div style="margin-top: 10px">Follow the <a style="font-weight: bold" href="https://www.twitter.com">course profile</a></div>
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
                                <a style="font-weight: bold" href="https://www.facebook.com">Group 1</a><br>
                                <a style="font-weight: bold" href="https://www.facebook.com">Group 2</a><br>
                                <a style="font-weight: bold" href="https://www.facebook.com">Group 3</a><br>
                                <div style="margin-top: 10px">Follow the official <a style="font-weight: bold" href="https://www.facebook.com">course page</a></div>
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

            <!--Sample chat popup start-->
            <div id="chat-frame" class="chat-frame">
                <div class="chat-name-bar">
                    <span class="material-icons grayed-out-icon">person</span>
                    <span style="font-weight: bold; margin-left: 5px; color: black; font-size: 12px; margin-top: 2px">John Doe</span>
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
        function loadReloadPopUp(post_id, reload=false) {
            document.getElementById("popup-backdrop-"+post_id).style.display = 'block';
            const xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", '/load-comments/'+post_id, false ); // false for synchronous request
            xmlHttp.send( null );
            const comments = JSON.parse(xmlHttp.response);
            let bodyHTML = "";
            comments.forEach(loopBody)
            function loopBody(item, index) {
                bodyHTML += "<div class='discussion-popup-message-box' style='margin-top: 10px'>" +
                    "<span>Sarah Flynn: </span>" +
                    "<span style='font-weight: normal'>" + item.text + "</span>" +
                    "<br><span style='font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px'>reply</span>" +
                    "</div>";
            }
            document.getElementById("discussion-body-"+post_id).innerHTML = bodyHTML;
            if (!reload) {
                document.getElementById("discussion-popup-"+post_id).style.display = 'block';
            }
        }
        async function closePopUp(post_id) {
            document.getElementById("discussion-body-"+post_id).innerHTML = null;
            document.getElementById("discussion-popup-"+post_id).style.display = 'none';
            let backdrop = document.getElementById("popup-backdrop-"+post_id);
            let alpha = 0.25;
            for (let i=0; i<10; i++) {
                alpha -= 0.05*i;
                backdrop.style.backgroundColor = 'rgba('+0+','+0+','+0+','+alpha+')';
                await new Promise(r => setTimeout(r, 25));
            }
            backdrop.style.display = 'none';
            backdrop.style.backgroundColor = 'rgba('+0+','+0+','+0+','+0.25+')';
        }
        function openChat() {
            document.getElementById("chat-frame").style.display = 'block';
        }
        function closeChat() {
            document.getElementById("chat-frame").style.display = 'none';
        }
        function openContents() {
            document.getElementById("contents").style.display = 'block';
            document.getElementById("tweet_content").type = 'hidden';
            document.getElementById("yt_content").type = 'hidden';
        }
        function openTweet() {
            document.getElementById("tweet_content").type = 'text';
            document.getElementById("yt_content").type = 'hidden';
        }
        function openYT() {
            document.getElementById("tweet_content").type = 'hidden';
            document.getElementById("yt_content").type = 'text';
        }

        /* Quill editor JS */
        Quill.register("modules/imageCompressor", imageCompressor);
        var quill = new Quill('#contents', {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'link'],
                    ['image', 'code-block']
                ],
                imageCompressor: {
                    quality: 0.9,
                    maxWidth: 500, // default
                    maxHeight: 500, // default
                }
            },
            placeholder: 'Share your ideas...',
            theme: 'snow'  // or 'bubble'
        });
        $("#post-form").on("submit",function(){
            var $input = $(this).find("input[name=quill_content]");
            var $qc = quill.root.innerHTML;
            $input.attr('value', $qc);
        });
        function editPost(postId) {
            var post = document.getElementById(postId);
            var content = post.childNodes.item(3).innerHTML;
            post.style.display = 'none';
            const delta = quill.clipboard.convert(content);
            quill.root.dataset.placeholder = '';
            quill.setContents(delta, 'silent');
            var id_input = document.getElementById("post_id");
            id_input.value = postId;
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
        function deletePost(postId) {
            fetch("/delete-post", {
                method: "POST",
                headers: {'Content-Type': 'application/json', "X-CSRF-Token": '{{csrf_token()}}'},
                body: JSON.stringify({
                    post_id: postId
                })
            }).then(res => {
                location.reload();
            });
        }
        function showEditOptions(postId) {
            var elem = document.getElementById("edit-dropdown-"+postId);
            if (elem.style.display == 'block') {
                elem.style.display = 'none';
            } else {
                elem.style.display = 'block';
            }
        }
        function submitComment(postId) {
            let comment = document.getElementById("comment_box_"+postId).value;
            document.getElementById("comment_box_"+postId).value = null;
            fetch("/save-comment", {
                method: "POST",
                headers: {'Content-Type': 'application/json', "X-CSRF-Token": '{{csrf_token()}}'},
                body: JSON.stringify({
                    post_id: postId,
                    comment: comment
                })
            }).then(res => {
                loadReloadPopUp(postId, true);
            });
        }
    </script>
@endsection