@foreach($data as $item)
    <div class="resource_tab_item_vertical">
        <div class="row">
            <div class="col-sm-10">
                @if($item->url)
                    <a href="{{$item->url}}">{{$item->title}}</a>
                @else()
                    <a>{{$item->title}}</a>
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
                <p style="font-size: small; margin-top: -2px">
                    {{$item->authors}}
                    @if($item->location)
                        at {{$item->location}}
                    @endif
                </p>
            </div>
        </div>
    </div>
@endforeach