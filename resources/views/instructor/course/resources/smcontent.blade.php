@extends('layouts.backend.index')
@section('content')
    <link href="{{ asset('backend/css/resources.css') }}" rel="stylesheet">
    @include('instructor.course.header')
    <div class="page-content">
        <div class="panel">
            <div class="panel-body">
                @include('instructor.course.tabs')
            @foreach(["tw", "fb"] as $sm)
                    <h4 id="{{$sm}}-header" class="resource-header" onclick="expandCollapseSection('{{$sm}}')">
                @switch($sm)
                    @case("tw")
                    Twitter content
                    </h4>
                    <hr>
                    @include('instructor.course.resources.sm-form',['type' => $sm, 'data' => $tw_content, 'name' => 'Twitter', 'lecs' => $lecs])
                    @break
                    @case("fb")
                    Facebook content
                    </h4>
                    <hr>
                    @include('instructor.course.resources.sm-form',['type' => $sm, 'data' => $fb_content, 'name' => 'Facebook', 'lecs' => $lecs])
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
        function fillResourceForm(item, res) {
            $("input[name='"+res+"_title']").val(item.title);
            $("input[name='"+res+"_url']").val(item.url);
            $("input[name='"+res+"_lecture']").val(item.lecture_id);
            if (res == 'tw') {
                $("input[name='"+res+"_is_hashtag']").prop('checked', item.is_hashtag);
            }
            $("input[name='"+res+"_sm_id']").val(item.id);
        }
        function editResource(item) {
            const res = item.sm_type;
            const expand = expandCollapseForm(res);
            if (expand) {
                fillResourceForm(item, res);
            }
        }
        function expandCollapseTableRow(item_id, type) {
            const elem = $("#"+item_id+"-"+type+"-cell");
            if (elem.attr('id'))
                if (elem.attr('class') == 'res-tab-data') {
                    elem.attr('class', 'res-tab-data-clicked');
                }
                else {
                    elem.attr('class', 'res-tab-data');
                }
        }
    </script>
@endsection