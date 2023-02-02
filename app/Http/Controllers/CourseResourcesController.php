<?php

/**
 * Created by github@WageeshaR
 * Date: 26 Jan 2023
 */

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseResource;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Image;
use Crypt;
use URL;
use Session;

class CourseResourcesController extends Controller
{
    public function __construct()
    {
        $this->model = new CourseResource();
    }

    public function getResources($course_id = '', Request $request) {

        $course = Course::find($course_id);
        $publications = CourseResource::where('resource_type', '=', 'pubs')->where('course_id', '=', $course_id)->get();
        $data = CourseResource::where('resource_type', 'data')->where('course_id', '=', $course_id)->get();
        $quizzes = CourseResource::where('resource_type', 'quiz')->where('course_id', '=', $course_id)->get();
        $video_footage = CourseResource::where('resource_type', 'vids')->where('course_id', '=', $course_id)->get();
        $other = CourseResource::where('resource_type', 'othr')->where('course_id', '=', $course_id)->get();

        return view('instructor.course.resources.resources', compact('course','publications', 'data', 'quizzes', 'video_footage', 'other'));
    }

    public function saveResource(Request $request) {
        $res = $request->res_type;
        if ($request->{$res.'_resource_id'}) {
            $resource = CourseResource::find($request->{$res.'_resource_id'});
        }
        else {
            $resource = new CourseResource();
        }
        $resource->course_id = $request->course_id;
        $resource->resource_type = $res;
        $resource->created_by = \Auth::user()->id;
        $resource->title = $request->{$res.'_title'};
        $resource->sub_title = $request->{$res.'_sub_title'};
        $resource->summary = $request->{$res.'_summary'};
        $resource->url = $request->{$res.'_url'};
        $resource->lecture_id = $request->{$res.'_lecture'};
        if ($request->file($res.'_file')) {
            $name = $request->file($res.'_file')->getClientOriginalName();
            $request->file($res.'_file')->storeAs('course_resources/'.$request->course_id, $name);
            $resource->file_name = $name;
        }
        $resource->save();
        $return_url = 'instructor-course-resources/'.$request->course_id;
        return redirect($return_url)->with('status', "Success");
    }

    public function deleteResource($course_id = '', $resource_id = '', Request $request) {
        CourseResource::destroy($resource_id);
        $return_url = 'instructor-course-resources/'.$course_id;
        return redirect($return_url)->with('status', "Success");
    }
}