@extends('layouts.backend.index')
@section('content')
    <link href="{{ asset('backend/css/resources.css') }}" rel="stylesheet">
    @include('instructor.course.header')
    <div class="page-content">
        <div class="panel">
            <div class="panel-body">
                @include('instructor.course.tabs')
                @foreach(["pubs", "data", "quiz", "vids", "othr"] as $res)
                    <h4 id="pubs-header" class="resource-header" onclick="expandCollapseSection('{{$res}}')">
                        @switch($res)
                            @case("pubs")
                            Publications
                            @break
                            @case("data")
                            Research Data
                            @break
                            @case("quiz")
                            Quizzes
                            @break
                            @case("vids")
                            Video Footage
                            @break
                            @case("othr")
                            Other Resources
                        @endswitch
                    </h4>
                    <hr>
                    @switch($res)
                        @case("pubs")
                        @include('instructor.course.resources.form',['type' => $res, 'data' => $publications])
                        @break
                        @case("data")
                        @include('instructor.course.resources.form',['type' => $res, 'data' => $data])
                        @break
                        @case("quiz")
                        @include('instructor.course.resources.form',['type' => $res, 'data' => $quizzes])
                        @break
                        @case("vids")
                        @include('instructor.course.resources.form',['type' => $res, 'data' => $video_footage])
                        @break
                        @case("othr")
                        @include('instructor.course.resources.form',['type' => $res, 'data' => $other])
                    @endswitch
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function expandCollapseSection(res) {
            let container = document.getElementById(res+"-container");
            if (container.style.display == 'block') {
                container.style.display = 'none';
            } else {
                container.style.display = 'block';
            }
        }
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
        $("input[type=file]").change(function() {
            const re = /(?:\.([^.]+))?$/;
            const id = $(this).attr('id');
            const f_name = $(this).prop('files')[0].name;
            const ext = re.exec(f_name);
            if (ext[0].toUpperCase() != '.PDF' && ext[0].toUpperCase() != '.DOC' && ext[0].toUpperCase() != '.DOCX') {
                alertify.confirm('Only .pdf, .doc and .docx file types are allowed', function () {
                    return false;
                }, function () {
                    return false;
                });
                $(this).val(null);
            }
            if ($(this).prop('files')[0]) {
              $('#'+id+'_upload_ph').val(f_name);
            }
        });
        function fillResourceForm(item, res) {
            $("input[name='"+res+"_title']").val(item.title);
            $("input[name='"+res+"_sub_title']").val(item.sub_title);
            $("input[name='"+res+"_file_upload_ph']").val(item.file_name);
            $("textarea[name='"+res+"_summary']").val(item.summary);
            $("input[name='"+res+"_url']").val(item.url);
            $("input[name='"+res+"_lecture']").val(item.lecture_id);
            $("input[name='"+res+"_resource_id']").val(item.id);

        }
        function editResource(item) {
            const res = item.resource_type;
            const expand = expandCollapseForm(res);
            if (expand) {
                fillResourceForm(item, res);
            }
        }
    </script>
@endsection