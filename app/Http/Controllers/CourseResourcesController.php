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
use SiteHelpers;
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

    /**
     * Used to load resources into lecture feed's resources portal (students have access)
     * @param string $course_slug
     * @param string $lecture_slug
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResourcesFrontend($course_slug = '', $lecture_slug = '', Request $request) {
        $course = Course::where('course_slug', $course_slug)->first();
        $discussion = DB::table('curriculum_lectures_quiz')
                    ->select('*')
                    ->where('lecture_quiz_id', SiteHelpers::encrypt_decrypt($lecture_slug, 'd'))->first();
        $res = $this->fetchAllResources($course->id);
        return view('site.course.feed.resources',
                array(
                    'course' => $course,
                    'discussion' => $discussion,
                    'publications' => $res['pubs'],
                    'data' => $res['data'],
                    'quizzes' => $res['quiz'],
                    'video_footage' => $res['vids'],
                    'other' => $res['othr']
                )
        );
    }

    public function getResourcesFEByType($course_slug = '', $lecture_slug = '', $type = '', Request $request) {
        $course_id = Course::where('course_slug', $course_slug)->first()->id;
        $lecture_id = DB::table('curriculum_lectures_quiz')
                    ->select('*')->where('lecture_quiz_id', SiteHelpers::encrypt_decrypt($lecture_slug, 'd'))->first()->id;
        $resource_data = CourseResource::where('resource_type', $type)->where('course_id', '=', $course_id)->get();
        return response()->json($resource_data);
    }

    /**
     * Used to load resources into facilitator's course resource management portal in backend
     * @param string $course_id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResourcesBackend($course_id = '', Request $request) {

        $course = Course::find($course_id);
        $res = $this->fetchAllResources($course->id);
        return view('instructor.course.resources.resources',
            array(
                'course' => $course,
                'publications' => $res['pubs'],
                'data' => $res['data'],
                'quizzes' => $res['quiz'],
                'video_footage' => $res['vids'],
                'other' => $res['othr']
            )
        );
    }

    /**
     * Used to save resources from facilitator's resource management portal
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Deletes a given resource coming from facilitator's resource management portal in backend
     * @param string $course_id
     * @param string $resource_id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteResource($course_id = '', $resource_id = '', Request $request) {
        CourseResource::destroy($resource_id);
        $return_url = 'instructor-course-resources/'.$course_id;
        return redirect($return_url)->with('status', "Success");
    }

    /**
     * Utility function to fetch all resource types from DB
     */
    public function fetchAllResources($course_id) {
        $publications = CourseResource::where('resource_type', 'pubs')->where('course_id', $course_id)->get();
        $data = CourseResource::where('resource_type', 'data')->where('course_id', $course_id)->get();
        $quizzes = CourseResource::where('resource_type', 'quiz')->where('course_id', $course_id)->get();
        $video_footage = CourseResource::where('resource_type', 'vids')->where('course_id', $course_id)->get();
        $other = CourseResource::where('resource_type', 'othr')->where('course_id', $course_id)->get();
        return array("pubs" => $publications, "data" => $data, "quiz" => $quizzes, "vids" => $video_footage, "othr" => $other);
    }
}