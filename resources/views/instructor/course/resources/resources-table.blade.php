<table class="table table-striped w-full">
    <thead>
    <tr>
        <th>Id</th>
        <th style="width: 100px;">Lecture</th>
        <th style="width: 200px;">Title</th>
        @if($type == "pubs")
            <th style="width: 150px;">Authors</th>
            <th style="width: 150px;">Publisher</th>
        @endif
        @if($type == "pubs" or $type == "data" or $type == "vids")<th style="width: 450px;">Summary</th>@endif
        @if($type == "pubs" or $type == "data")<th style="min-width: 150px">Resource URL</th>@endif
        <th style="min-width: 100px;">File</th>
        <th style="width: auto;">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->lecture_id}}</td>
            <td id="{{$item->id}}-t-cell" onclick="expandCollapseTableRow({{$item->id}}, 't')" class="res-tab-data">{{$item->title}}</td>
            @if($type == "pubs")
                <td id="{{$item->id}}-st-cell" onclick="expandCollapseTableRow({{$item->id}}, 'st')" class="res-tab-data">{{$item->authors}}</td>
                <td id="{{$item->id}}-st-cell" onclick="expandCollapseTableRow({{$item->id}}, 'st')" class="res-tab-data">{{$item->publisher}}</td>
            @endif
            @if($type == "pubs" or $type == "data" or $type == "vids")
                <td id="{{$item->id}}-sm-cell" onclick="expandCollapseTableRow({{$item->id}}, 'sm')" class="res-tab-data">
                    {{$item->summary}}
                </td>
            @endif
            @if($type == "pubs" or $type == "data")<td class="res-tab-data"><a href="{{$item->url}}">{{$item->url}}</a></td>@endif
            <td class="res-tab-data">{{$item->file_name}}</td>
            <td>
                <button onclick="editResource({{$item}})" href="" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                </button>

                <a href="{{ url('instructor-course-resources-delete/'.$item->course_id.'/'.$item->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete" >
                    <i class="icon wb-trash" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>