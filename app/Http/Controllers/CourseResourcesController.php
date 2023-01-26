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

    public function getCourseResources($course_id = '', Request $request) {

        $course = Course::find($course_id);
        $publications = CourseResource::where('resource_type', '=', 'pubs')->where('course_id', '=', $course_id)->get();
        $data = CourseResource::where('resource_type', 'data')->where('course_id', '=', $course_id)->get();
        $quizzes = CourseResource::where('resource_type', 'quiz')->where('course_id', '=', $course_id)->get();
        $video_footage = CourseResource::where('resource_type', 'vids')->where('course_id', '=', $course_id)->get();
        $other = CourseResource::where('resource_type', 'othr')->where('course_id', '=', $course_id)->get();

        return view('instructor.course.resources', compact('course','publications', 'data', 'quizzes', 'video_footage', 'other'));
    }

    public function saveResource(Request $request) {
        $resource = new CourseResource();
        $resource->course_id = $request->course_id;
        $resource->resource_type = $request->res_type;
        $resource->created_by = \Auth::user()->id;
        $resource->title = $request->title;
        $resource->sub_title = $request->sub_title;
        $resource->summary = $request->description;
        $resource->url = $request->url;
        if ($request->file) {
            // TODO: implement file upload
        }
        $resource->save();
        $return_url = 'instructor-course-resources/'.$request->course_id;
        return redirect($return_url)->with('status', "Success");
    }
}