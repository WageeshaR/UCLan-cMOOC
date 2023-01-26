<?php

/**
 * Created by github@WageeshaR
 * Date: 26 Jan 2023
 */

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseResources;
use Illuminate\Http\Request;
use DB;
use Image;
use Crypt;
use URL;
use Session;

class CourseResourcesController extends Controller
{
    public function __construct()
    {
        $this->model = new CourseResources();
    }

    public function getCourseResources($course_id = '', Request $request) {

        $course = Course::find($course_id);
        $publications = CourseResources::where('resource_type', '=', 'PUB')->where('course_id', '=', $course_id)->get();
        $data = CourseResources::where('resource_type', 'DAT')->where('course_id', '=', $course_id)->get();
        $quizzes = CourseResources::where('resource_type', 'QIZ')->where('course_id', '=', $course_id)->get();
        $video_footage = CourseResources::where('resource_type', 'VID')->where('course_id', '=', $course_id)->get();
        $other = CourseResources::where('resource_type', 'OTH')->where('course_id', '=', $course_id)->get();

        return view('instructor.course.resources', compact('course','publications', 'data', 'quizzes', 'video_footage', 'other'));
    }
}