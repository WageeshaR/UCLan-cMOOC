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
            <div class="row">
                <div class="resource-button" onclick="expandCollapseForm('access_grants')">New grant +</div>
            </div>
            <div id="access_grants-form-body" style="display: none">
                <form method="POST" action="{{ route('instructor.access.grants.save') }}" id="access_grants_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div id="student-container" class="form-group col-sm-4">
                            <label class="form-control-label">Student</label>
                            <select data-chosen="" onchange="this.dataset.chosen = this.value;" name="student_id">
                                <option class="lec-select-option" value="">Select the student</option>
                                @foreach($students as $student)
                                    <option class="lec-select-option" value="{{$student->id}}">{{$student->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="form-control-label">Course</label>
                            <select data-chosen="" onchange="this.dataset.chosen = this.value;" name="course_id" required>
                                <option class="lec-select-option" value="">Select the course applicable</option>
                                @foreach($courses as $course)
                                    <option class="lec-select-option" value="{{$course->id}}">{{$course->course_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="form-control-label">Grant access to all students</label><br>
                            <input onclick="clickAllAccess()" type="checkbox" style="width: 35px; height: 35px; margin-right: 6px;" name="grant_all" id="grant_all">
                        </div>
                    </div>
                    <div class="row">
                        <div id="granter-container" class="form-group col-sm-4">
                            <label class="form-control-label">Toggle the slider "on/off" to "approve/dismiss" grants.</label><br>
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
</div>
@endsection
@section('javascript')
    <script>
        function expandCollapseForm(res) {
            let container = document.getElementById(res+"-form-body");
            if (container.style.display == 'block') {
                container.style.display = 'none';
                return false;
            } else {
                container.style.display = 'block';
                return true;
            }
        }
        function clickAllAccess() {
            const elem = $("#student-container");
            if (elem.css('display') == 'block') {
                elem.hide();
            } else {
                elem.show();
            }
        }
    </script>
@endsection