@extends('layouts.backend.index')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Institution Management</li>
        </ol>
        <h1 class="page-title">Institution Management</h1>
    </div>

    <div class="page-content">

        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <a href="{{ route('admin.getInstitutionForm') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add Institution</a>
                </div>

                <div class="panel-actions">
                    <form method="GET" action="{{ route('admin.institutions') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                              <a href="{{ route('admin.institutions') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
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
                        <th>Type</th>
                        <th>Name</th>
                        <th>Contact Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($institutions as $institution)
                        <tr>
                            <td>{{ $institution->id }}</td>
                            <td>{{ $institution->type }}</td>
                            <td>{{ $institution->name }}</td>
                            <td>{{ $institution->contact }}</td>
                            <td>
                                <a href="{{ url('admin/institution-form/'.$institution->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit">
                                    <i class="icon wb-pencil" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="float-right">
                    {{ $institutions->appends(['search' => Request::input('search')])->links() }}
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