<div class="feed-menu-right">
    <span>More on <b>{{ $course->course_title }}</b></span>
    <div>
        <div id="social-container">
            <div>
                <span id="twitter">Twitter</span>
                <img src="{{asset('frontend/icons/Twitter.png')}}" height="27.5px" style="padding-bottom: 10px">
            </div>
            <div>
                <span>Popular within this course</span><br>
                @foreach($tw_content as $tc)
                    @if($tc->is_hashtag)
                        <a class="sm-tags" target="_blank" href="https://twitter.com/hashtag/{{$tc->title}}?src=hashtag_click">{{$tc->title}}</a>
                    @else
                        <a class="sm-tags" target="_blank" href="{{$tc->url}}">{{$tc->title}}</a>
                    @endif
                @endforeach
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
                    <span>Join discussions on below spaces</span><br>
                    @foreach($fb_content as $tc)
                        <a class="sm-tags" target="_blank" href="{{$tc->url}}">{{$tc->title}}</a>
                    @endforeach
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