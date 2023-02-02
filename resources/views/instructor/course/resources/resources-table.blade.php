<table class="table table-hover table-striped w-full">
    <thead>
    <tr>
        <th>Id</th>
        <th>Attached Lecture</th>
        <th>Title</th>
        <th>Sub Title</th>
        <th>Description</th>
        <th>Resource URL</th>
        <th>File</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($res as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->lecture_id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->sub_title }}</td>
            <td>{{ $item->summary }}</td>
            <td>
                <a href="{{$item->url}}">
                    {{ $item->url }}
                </a>
            </td>
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