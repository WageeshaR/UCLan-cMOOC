<div id="{{$type}}-container" style="display: none">
    @include('instructor.course.resources.resources-table', ['res' => $data])
    <div class="resource-button" id="new-resource-button" name="new-resource-button" onclick="expandCollapseForm('{{$type}}')">Add new</div>
    <div id="{{$type}}-form-body" style="display: none">
        <form method="POST" action="{{ route('instructor.course.resources.save') }}" id="{{$type}}_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="res_type" value="{{$type}}">
            <input type="hidden" name="{{$type}}_resource_id">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-control-label">Publication Title<span class="required">*</span></label>
                    <input type="text" class="form-control" name="{{$type}}_title"
                           placeholder="Title" value="" />
                </div>
                <div class="form-group col-md-4">
                    <label class="form-control-label">Publication Sub Title</label>
                    <input type="text" class="form-control" name="{{$type}}_sub_title"
                           placeholder="Sub title" value="" />
                </div>
                <div class="form-group col-md-2">
                    <label class="form-control-label">Upload Document</label>
                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                        <input id="{{$type}}_file_upload_ph" name="{{$type}}_file_upload_ph" type="text" class="form-control" readonly="" placeholder="Select from your device">
                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                <i class="icon wb-upload" aria-hidden="true"></i>
                                                <input type="file" class="item-img file center-block" name="{{$type}}_file" id="{{$type}}_file" />
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
                    <textarea class="form-control description-box" name="{{$type}}_summary" placeholder="Description" value=""></textarea>
                </div>
                <div class="form-group col-md-4">
                    <label class="form-control-label">Publication URL</label>
                    <input type="text" class="form-control" name="{{$type}}_url"
                           placeholder="URL" value="" />
                </div>
                <div class="form-group col-md-4">
                    <label class="form-control-label">Attach a Lecture</label>
                    <input type="text" class="form-control" name="{{$type}}_lecture"
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