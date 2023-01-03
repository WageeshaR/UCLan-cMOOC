@extends('layouts.backend.index')
@section('content')

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('common.blogForm') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add Blog</a>
            </div>
          
          <div class="panel-actions">
          <form method="GET" action="{{ route('common.blogs.index') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('admin.blogs') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
                </span>
              </div>
          </form>
          </div>
        </div>
        
        <div class="panel-body">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>Sl.no</th>
                <th>Attached Lecture</th>
                <th>Blog Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($blogs as $blog)
              <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ $blog->lecture }}</td>
                <td>{{ $blog->blog_title }}</td>
                <td>{{ $blog->blog_slug }}</td>
                <td>
                  @if($blog->is_active)
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">Inactive</span>
                  @endif
                </td>
                <td>
                    <a href="{{ url('blog-read/'.$blog->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="View" >
                        <i class="icon wb-eye" aria-hidden="true"></i>
                    </a>
                    @if(Auth::user()->id == $blog->author_id)
                        <a href="{{ url('common-blog-form/'.$blog->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit" >
                            <i class="icon wb-pencil" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('common-delete-blog/'.$blog->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete" >
                            <i class="icon wb-trash" aria-hidden="true"></i>
                        </a>
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          <div class="float-right">
            {{ $blogs->appends(['search' => Request::input('search')])->links() }}
          </div>
          
          
        </div>
      </div>
      <!-- End Panel Basic -->
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 

    });
</script>
@endsection