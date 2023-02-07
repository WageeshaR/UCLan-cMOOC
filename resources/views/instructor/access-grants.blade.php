@extends('layouts.backend.index')
@section('content')
<link href="{{ asset('backend/css/resources.css') }}" rel="stylesheet">
<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Access Grants</li>
    </ol>
    <h1 class="page-title">Access Grants</h1>
</div>

<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            <form method="POST" action="{{ route('instructor.access.grants.save') }}" id="access_grants_form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="form-control-label">Student</label>
                        <select name="student_id" required>
                            <option class="lec-select-option" value="">Select the student</option>
                            @foreach($students as $student)
                                <option class="lec-select-option" value="{{$student->id}}">{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="form-control-label">Course</label>
                        <select name="course_id" required>
                            <option class="lec-select-option" value="">Select the course applicable</option>
                            @foreach($courses as $course)
                                <option class="lec-select-option" value="{{$course->id}}">{{$course->course_title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="form-control-label">Approve grants </label>
                        <label class="switch">
                            <input name="grant_value" type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-default btn-outline">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection