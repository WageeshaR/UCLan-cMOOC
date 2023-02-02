<table class="table table-hover table-striped w-full">
    <thead>
    <tr>
        <th>Id</th>
        <th>Attached Lecture</th>
        <th>Title</th>
        @if($type == "pubs")<th>Sub Title</th>@endif
        @if($type == "pubs" or $type == "data" or $type == "vids")<th>Description</th>@endif
        @if($type == "pubs" or $type == "data")<th>Resource URL</th>@endif
        <th>File</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->lecture_id }}</td>
            <td>{{ $item->title }}</td>
            @if($type == "pubs")<td>{{ $item->sub_title }}</td>@endif
            @if($type == "pubs" or $type == "data" or $type == "vids")<td>{{ $item->summary }}</td>@endif
            @if($type == "pubs" or $type == "data")<td><a href="{{$item->url}}">{{ $item->url }}</a></td>@endif
            <td>{{ $item->file_name }}</td>
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