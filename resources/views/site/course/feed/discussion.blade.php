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
            @include('site.course.feed.feed-column-left', ['course' => $course, 'discussion' => $discussion]);
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
                        <span id="empty-tag" style="color: red; margin-left: 5px; display: none">Form is empty</span>
                    </div>
                    <div class="post-button-group">
                        <button type="submit" class="post-button">Post</button>
                        <img src="{{asset('frontend/icons/textbox.jpg')}}" height="40px" class="post-clickable-icon" onclick="openContents()">
                        <img src="{{asset('frontend/icons/Twitter.png')}}" height="40px" class="post-clickable-icon" onclick="openTweet()">
                        <img src="{{asset('frontend/icons/YT.png')}}" height="40px" class="post-clickable-icon" onclick="openYT()">
                    </div>
                </form>
                @foreach($posts as $post)
                    <div class="published-post-frame" id="{{$post->post_id}}">
                        <div class="post-header">
                            <div>
                                <a style="cursor: pointer; color: #346d3d" onclick="openUserProfile({{$post->post_id}})">
                                    @if($post->anonymize)
                                        Anonymous User
                                    @else
                                        {{$post->first_name . ' ' . $post->last_name}}
                                    @endif
                                </a>
                                <span style="font-weight: normal; font-size: 12px; color: rgb(200,200,200); margin-left: 5px">
                                    <?php
                                        $timestamp = strtotime($post->created_at);
                                        $strTime = array("second", "minute", "hour", "day", "month", "year");
                                        $length = array("60","60","24","30","12","10");
                                        $diff     = time()- $timestamp;
                                        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                                            $diff = $diff / $length[$i];
                                        }
                                        $diff = round($diff);
                                        echo $post->institution . " &bull; " . $diff . " " . $strTime[$i] . "(s) ago". " &bull; " . $post->location;
                                    ?>
                                    @if($post->approved)
                                        <span class="approved-icon">APPROVED</span>
                                    @else
                                        <span class="to-be-approved-icon">NOT APPROVED YET</span>
                                    @endif
                                </span>
                            </div>
                            <div class="dropdown">
                                <span style="user-select: none" title="edit post" class="material-icons grayed-out-icon" onclick="showEditOptions({{$post->post_id}})">more_vert</span>
                                <div class="dropdown-content" id="edit-dropdown-{{$post->post_id}}">
                                    <a href="#" onclick="editPost({{$post->post_id}})">Edit</a>
                                    <a href="#" onclick="deletePost({{$post->post_id}})">Delete</a>
                                    @if(Auth::user()->hasRole('facilitator') && $post->approved == false)
                                        <a href="#" onclick="approvePost({{$post->post_id}})">Approve</a>
                                    @endif
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
                            <span title="make trending" class="material-icons grayed-out-icon">trending_up</span>
                            <span onclick="loadReloadPopUp({{$post->post_id}})" id="discussion" title="discussion" class="material-icons grayed-out-icon">comment</span>
                            <span title="share" class="material-icons grayed-out-icon">share</span>
                            <span onclick="openChat()" title="send to a chat" class="material-icons grayed-out-icon">send</span>
                        </div>
                        <div class="popup-backdrop" id="popup-backdrop-{{$post->post_id}}">
                            <div id="discussion-popup-{{$post->post_id}}" class="discussion-popup-frame">
                                <div style="margin-top: 0px">
                                    <button onclick="closePopUp({{$post->post_id}})" class="popup-close-button">close</button>
                                </div>
                                <div id="comment-container" class="comment-container">
                                    <textarea type="text" placeholder="what are your thoughts.." id="comment_box_{{$post->post_id}}" name="comment_box_{{$post->post_id}}" class="comment-box"></textarea>
                                    <button onclick="submitComment({{$post->post_id}})" class="comment-button">comment</button>
                                </div>
                                <div id="discussion-body-{{$post->post_id}}"></div>
                            </div>
                        </div>
                        @include('site.course.user-profile-popup', ['post' => $post, 'course_slug' => $course->course_slug, 'lecture_slug' => SiteHelpers::encrypt_decrypt($discussion->lecture_quiz_id)])
                    </div>
                @endforeach
            </div>
            @include('site.course.feed.feed-column-right', ['course' => $course, 'tw_content' => $tw_content, 'fb_contant' => $fb_content]);
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
        function openUserProfile(id) {
            $("#user-profile-model-"+id).show();
        }
        function closeUserProfile(id) {
            $("#user-profile-model-"+id).hide();
        }
        function loadReloadPopUp(post_id, reload=false) {
            document.getElementById("popup-backdrop-"+post_id).style.display = 'block';
            const xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", '/load-comments/'+post_id, false ); // false for synchronous request
            xmlHttp.send( null );
            const comments = JSON.parse(xmlHttp.response);
            let bodyHTML = "";
            comments.forEach(loopBody)
            function loopBody(item, index) {
                const t = item.created_at.split(/[- :]/);
                const created_at = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                const today = new Date();
                const diffMs = (today - created_at);
                let diff = 0;
                const diffInDays = Math.floor(diffMs / 86400000);
                if (diffInDays == 0) {
                    var diffInHrs = Math.floor((diffMs % 86400000) / 3600000);
                    if (diffInHrs == 0) {
                        var diffInMins = Math.round(((diffMs % 86400000) % 3600000) / 60000);
                        diff = diffInMins + "m ago";
                    } else {
                        diff = diffInHrs + "h ago";
                    }
                } else {
                    diff = diffInDays + "d ago";
                }
                bodyHTML += "<div class='discussion-popup-message-box' style='margin-top: 10px'>" +
                    "<span>" + item.fn + " " + item.ln + " </span>" +
                    "<span style='font-weight: lighter; color: lightgrey'>" + diff + " </span>" +
                    "<span style='font-weight: normal'>" + item.text + "</span>" +
                    "<br>" +
                    "<span onclick='reply("+ item.id +")' style='font-weight: normal; color: lightgrey; cursor: pointer; margin-left: 5px'>reply</span>" +
                    "<br>" +
                    "<div id='reply-container-" + item.id +"' class='reply-container'>" +
                        "<textarea type='text' placeholder='your reply..' id='reply_box_" + item.id + "' name='reply_box_" + item.id + "' class='reply-box'></textarea>" +
                        "<button onclick='submitComment(" + post_id + ","+ item.id +")' class='reply-button'>reply</button>" +
                    "</div>" +
                    "</div>";
                if (item.replies && item.replies.length > 0) {
                    item.replies.forEach(replyLoopBody)
                }
            }
            function replyLoopBody(item, index) {
                bodyHTML += "<div id='popup-reply-box-"+ item.id +"' class='discussion-popup-reply-box'>" +
                    "<span>" + item.fn + " " + item.ln + " </span>" +
                    "<span style='font-weight: normal'>"+ item.text +"</span>" +
                    "</div>"
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
        $("#post-form").on("submit",function(e){
            var $input = $(this).find("input[name=quill_content]");
            var $qc = quill.root.innerHTML;
            if (quill.getLength() <= 1 && $("#tweet_content").val() == '' && $("#yt_content").val() == '') {
                e.preventDefault();
                $("#empty-tag").show();
                setTimeout(() => {
                    $("#empty-tag").hide();
                }, 5000);
            }
            $input.attr('value', $qc);
        });
        function approvePost(postId) {
            fetch("/approve-post", {
                method: "POST",
                headers: {'Content-Type': 'application/json', "X-CSRF-Token": '{{csrf_token()}}'},
                body: JSON.stringify({
                    post_id: postId
                })
            }).then(res => {
                location.reload();
            });
        }
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
        function submitComment(postId, parentId) {
            let comment = "";
            if (!parentId) {
                comment = document.getElementById("comment_box_"+postId).value;
                document.getElementById("comment_box_"+postId).value = null;
            }
            else {
                comment = document.getElementById("reply_box_"+parentId).value;
                document.getElementById("reply_box_"+parentId).value = null;
            }
            fetch("/save-comment", {
                method: "POST",
                headers: {'Content-Type': 'application/json', "X-CSRF-Token": '{{csrf_token()}}'},
                body: JSON.stringify({
                    post_id: postId,
                    parent_id: parentId,
                    comment: comment
                })
            }).then(res => {
                loadReloadPopUp(postId, true);
            });
        }
        function reply(commentId) {
            let reply_container = document.getElementById("reply-container-"+commentId);
            if (reply_container.style.display == 'flex') {
                reply_container.style.display = 'none'
            } else {
                reply_container.style.display = 'flex';
            }
        }
    </script>
@endsection