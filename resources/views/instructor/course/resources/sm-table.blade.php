<table class="table table-striped w-full">
    <thead>
    <tr>
        <th>Id</th>
        <th style="width: 100px;">Lecture</th>
        <th style="width: 200px;">Title</th>
        <th style="min-width: 150px">URL (web link)</th>
        <th style="min-width: 100px;">Only a hashtag</th>
        <th style="width: auto;">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->lecture_id}}</td>
            <td id="{{$item->id}}-t-cell" onclick="expandCollapseTableRow({{$item->id}}, 't')" class="res-tab-data">{{$item->title}}</td>
            <td class="res-tab-data"><a href="{{$item->url}}">{{$item->url}}</a></td>
            @if($item->is_hashtag)
                <td type="" class="res-tab-data">Yes</td>
            @else
                <td type="" class="res-tab-data">No. With a URL</td>
            @endif
            <td>
                <button onclick="editResource({{$item}})" href="" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                </button>

                <a href="{{ url('instructor-course-sm-content-delete/'.$item->course_id.'/'.$item->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete" >
                    <i class="icon wb-trash" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>