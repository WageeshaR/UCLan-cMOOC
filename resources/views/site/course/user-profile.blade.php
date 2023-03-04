<div id="user-profile-model-{{$post->id}}" class="user-profile-bg">
    <div class="user-profile-container">
        <div style="margin-top: 0px">
            <button onclick="closeUserProfile({{$post->id}})" class="popup-close-button">close</button>
        </div>
            <div class="user-profile-pic">
                <img height="200px" src="@if(Storage::exists('user_resources/'.$post->author_id.'/profile_pic')){{ url('storage/user_resources/'.$post->author_id.'/profile_pic') }}@else{{ asset('frontend/img/avatar.png') }}@endif">
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
                    {{ $post->first_name . ' ' . $post->last_name }}
                </span>
            </div>
            <hr>
            <div class="row justify-content-center">
                <h5>Institution: {{ $post->institution }}</h5>
            </div>
            <div class="row justify-content-center">
                <h5>Email: {{ $post->email }}</h5>
            </div>
            <div class="row justify-content-center">
                <h5>Contact no: </h5>
            </div>
    </div>
</div>