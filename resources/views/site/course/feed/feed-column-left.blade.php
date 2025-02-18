<div class="feed-menu-left">
    <a class="left-menu-item" id="home" href="{{ url('course-enroll/'.$course->course_slug.'/'.SiteHelpers::encrypt_decrypt($discussion->lecture_quiz_id)) }}">
        <i style="font-size: 32px; color: #346d3d" class="material-icons">home</i>
        <span style="font-size: 20px; color: #346d3d; margin-left: 20px">Feed</span>
    </a>
    <a class="left-menu-item" id="profile" href="{{ url('course-feed/'.$course->course_slug.'/'.SiteHelpers::encrypt_decrypt($discussion->lecture_quiz_id).'/user-profile/'.Auth::user()->id) }}">
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