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
            <td>{{ $item->url }}</td>
            <td>{{ $item->file }}</td>
            <td>
                <a href="{{ route('instructor.course.info.edit', $course->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                </a>

                <a href="{{ url('instructor-course-delete/'.$course->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete" >
                    <i class="icon wb-trash" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>