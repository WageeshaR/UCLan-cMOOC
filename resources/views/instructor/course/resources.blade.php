@extends('layouts.backend.index')
@section('content')
    <link href="{{ asset('backend/css/resources.css') }}" rel="stylesheet">
    @include('instructor.course.header')
    <div class="page-content">
        <div class="panel">
            <div class="panel-body">
                @include('instructor.course.tabs')
                <h4 id="pubs-header" class="resource-header" onclick="expandCollapseSection('pubs')">Publications</h4>
                <hr>
                <div id="pubs-container" style="display: none">
                    @include('instructor.course.resources-table', ['res' => $publications])
                    <div class="resource-button" id="new-resource-button" name="new-resource-button" onclick="expandCollapseForm('pubs')">Add new</div>
                    <div id="pubs-form-body" style="display: none">
                        <form method="POST" action="{{ route('instructor.course.resources.save') }}" id="pubs_form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="res_type" value="pubs">
                            <input type="hidden" name="pubs_resource_id">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="form-control-label">Publication Title<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="pubs_title"
                                           placeholder="Title" value="" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-control-label">Publication Sub Title</label>
                                    <input type="text" class="form-control" name="pubs_sub_title"
                                           placeholder="Sub title" value="" />
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-control-label">Upload Document</label>
                                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                        <input id="pubs_file_upload_ph" name="pubs_file_upload_ph" type="text" class="form-control" readonly="" placeholder="Select from your device">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                <i class="icon wb-upload" aria-hidden="true"></i>
                                                <input type="file" class="item-img file center-block" name="pubs_file" id="pubs_file" />
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-control-label" style=""></label>
                                    <div style="font-size: 10px; margin-top: 20px">
                                        Supported File Formats: pdf,doc,docx
                                        <br> Max File Size: 10MB
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="form-control-label">Short Description</label>
                                    <textarea class="form-control description-box" name="pubs_summary" placeholder="Description" value=""></textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-control-label">Publication URL</label>
                                    <input type="text" class="form-control" name="pubs_url"
                                           placeholder="URL" value="" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-control-label">Attach a Lecture</label>
                                    <input type="text" class="form-control" name="pubs_lecture"
                                           placeholder="Lecture" value="" />
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-default btn-outline">Reset</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <h4 id="data-header" class="resource-header">Research data</h4>
                <hr>
                <h4 id="quiz-header" class="resource-header">Quizzes</h4>
                <hr>
                <h4 id="vids-header" class="resource-header">Video footage</h4>
                <hr>
                <h4 id="othr-header" class="resource-header">Other resources</h4>
                <hr>
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