<div id="{{$type}}-container" style="display: none">
    @include('instructor.course.resources.sm-table', ['type' => $type, 'data' => $data, 'name' => $name])
    <div class="resource-button" id="new-resource-button" name="new-resource-button" onclick="expandCollapseForm('{{$type}}')">Add new</div>
    <div id="{{$type}}-form-body" style="display: none">
        <form method="POST" action="{{ route('instructor.course.smContent.save') }}" id="{{$type}}_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="sm_type" value="{{$type}}">
            <input type="hidden" name="{{$type}}_sm_id">
            <div class="row">
                <div class="form-group col-md-4">
                    @if($type == 'tw')
                        <label class="form-control-label">Title or hashtag<span class="required">*</span></label>
                    @else
                        <label class="form-control-label">Title<span class="required">*</span></label>
                    @endif
                    <input type="text" class="form-control" name="{{$type}}_title"
                           placeholder="Title" value="" />
                </div>
                <div class="form-group col-md-4">
                    <label class="form-control-label">URL (web link)</label>
                    <input type="text" class="form-control" name="{{$type}}_url"
                           placeholder="URL" value="" />
                </div>
                <div class="form-group col-md-4">
                    <label class="form-control-label">Attached Lecture</label>
                    <div class="select-div">
                        <select class="lec-select" name="{{$type}}_lecture" id="cars" placeholder="Select a lecture">
                            <option class="lec-select-option" value="0">Select a lecture</option>
                            @foreach($lecs as $lec)
                                <option class="lec-select-option" value="{{$lec->lecture_quiz_id}}">{{$lec->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @if($type == 'tw')
                <div class="row">
                    <div class="col-sm-6 hashtag-checkbox">
                        <input style="width: 12px; height: 12px; margin-right: 6px" type="checkbox" name="{{$type}}_is_hashtag">
                        <label>Please check if you're adding just a hashtag without URL</label>
                    </div>
                </div>
            @endif
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