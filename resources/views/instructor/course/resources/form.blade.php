<div id="{{$type}}-container" style="display: none">
    @include('instructor.course.resources.resources-table', ['type' => $type, 'data' => $data, 'name' => $name])
    <div class="resource-button" id="new-resource-button" name="new-resource-button" onclick="expandCollapseForm('{{$type}}')">Add new</div>
    <div id="{{$type}}-form-body" style="display: none">
        <form method="POST" action="{{ route('instructor.course.resources.save') }}" id="{{$type}}_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="res_type" value="{{$type}}">
            <input type="hidden" name="{{$type}}_resource_id">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-control-label">{{$name}} Title<span class="required">*</span></label>
                    <input type="text" class="form-control" name="{{$type}}_title"
                           placeholder="Title" value="" />
                </div>
                @if($type == "pubs")
                    <div class="form-group col-md-4">
                        <label class="form-control-label">Authors</label>
                        <input type="text" class="form-control" name="{{$type}}_authors"
                               placeholder="Author names (comma separated)" value="" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label">Published On</label>
                        <input type="text" class="form-control" name="{{$type}}_publisher"
                               placeholder="Conference, Journal etc." value="" />
                    </div>
                @endif
                <div class="form-group col-md-2">
                    <label class="form-control-label">Upload {{$name}}</label>
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
                        Supported File Formats:
                        @if($type != 'vids')
                            pdf,doc,docx
                            @if($type == 'data')
                                ,csv,xlsx
                            @endif
                        @else
                            mp4,webm
                        @endif
                        <br> Max File Size: 10MB
                    </div>
                </div>
            </div>
            <div class="row">
                @if($type == "pubs" or $type == "data" or $type == "vids")
                    <div class="form-group col-md-4">
                        <label class="form-control-label">Short Description</label>
                        <textarea class="form-control description-box" name="{{$type}}_summary" placeholder="Description" value=""></textarea>
                    </div>
                    @if($type != "vids")
                        <div class="form-group col-md-4">
                            <label class="form-control-label">{{$name}} URL</label>
                            <input type="text" class="form-control" name="{{$type}}_url"
                                   placeholder="URL" value="" />
                        </div>
                    @endif
                @endif
                <div class="form-group col-md-4">
                    <label class="form-control-label">Attached Lecture</label>
                    <div class="">
                        <select data-chosen="" onchange="this.dataset.chosen = this.value;" name="{{$type}}_lecture" id="cars">
                            <option class="lec-select-option" value="">Select a lecture</option>
                            @foreach($lecs as $lec)
                                <option class="lec-select-option" value="{{$lec->lecture_quiz_id}}">{{$lec->title}}</option>
                            @endforeach
                        </select>
                    </div>
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