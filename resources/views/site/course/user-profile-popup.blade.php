<div id="user-profile-model-{{$post->post_id}}" class="user-profile-bg">
    <div class="user-profile-container">
        <div style="margin-top: 0px">
            <button onclick="closeUserProfile({{$post->post_id}})" class="popup-close-button">close</button>
        </div>
            <div class="user-profile-pic">
                @if(!$post->anonymize)
                    <img height="200px" src="@if(Storage::exists('user_resources/'.$post->author_id.'/profile_pic')){{ url('storage/user_resources/'.$post->author_id.'/profile_pic') }}@else{{ asset('frontend/img/avatar.png') }}@endif">
                @else
                    <img height="200px" src="{{ asset('frontend/img/avatar.png') }}">
                @endif
                @if($post->author_id == Auth::user()->id)
                    <div style="margin-top: 180px; margin-left: 2px; cursor: pointer">
                        <form action="{{ route('user.profilePicUpload', ['course_slug' => $course_slug, 'lecture_slug' => $lecture_slug]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="file-upload" class="custom-file-upload">
                                <i style="font-size: 22px;" class="material-icons">edit</i>
                            </label>
                            <input id="file-upload" name="profile-pic" onchange="this.form.submit()" type="file"/>
                        </form>
                    </div>
                @endif
            </div>
            <div class="text-center">
                <span style="font-size: 30px; font-weight: bolder">
                    @if($post->author_id == Auth::user()->id)
                        {{ $post->first_name . ' ' . $post->last_name }}
                    @else
                        Anonymous User
                    @endif
                </span>
            </div>
            <hr>
            <div class="row justify-content-center">
                @if($post->author_id == Auth::user()->id)
                    <h5>Institution: {{ $post->institution }}</h5>
                @else
                    Anonymous Institution
                @endif
            </div>
            @if($post->author_id == Auth::user()->id)
                <div class="row justify-content-center">
                    <h5>Email: {{ $post->email }}</h5>
                </div>
                <div class="row justify-content-center">
                    <h5>Contact no: </h5>
                </div>
            @endif
            @if($post->author_id == Auth::user()->id)
                <div class="row justify-content-center">
                    <h5>Anonymize details: </h5>
                    <input id="anonymize-input" name="anonymize-input" type="checkbox" @if(Auth::user()->anonymize) checked @endif onchange="anonymize(this)">
                </div>
            @endif
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