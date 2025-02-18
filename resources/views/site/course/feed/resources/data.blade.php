@if(\Illuminate\Support\Facades\Auth::user()->hasRole('privileged student'))
    @foreach($data as $item)
        <div id="data-{{$item->id}}" class="resource_tab_item_vertical">
            <div class="row">
                <div class="col-sm-10">
                    @if($item->url)
                        <a style="display: flex; flex-direction: row; align-items: center" href="//{{$item->url}}">
                            <i style="font-size: 32px; color: lightgrey; margin-right: 5px" class="material-icons">folder</i>
                            <span id="title-tag">{{$item->title}}</span>
                        </a>
                    @else
                        <a style="display: flex; flex-direction: row; align-items: center">
                            <i style="font-size: 32px; color: lightgrey; margin-right: 5px" class="material-icons">folder</i>
                            <span id="title-tag">{{$item->title}}</span>
                        </a>
                    @endif
                </div>
                <div class="col-sm-2 res-download">
                    @if($item->file_name)
                        <a href="{{route('course.resource.download', ['course_id' => $course_id, 'file_name' => $item->file_name])}}">Download</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <p class="res-summary">{{$item->summary}}</p>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div id="no-access-banner" class="no-access-banner">
        <h1>ACCESS RESTRICTED<br></h1>
        <span>You can request "view" access by submitting a request.
            <span onclick="requestAccess({{$course_id}}, 'privileged-student')" class="no-href-link">Send an email</span> to the course facilitator.
        </span>
    </div>
@endif
