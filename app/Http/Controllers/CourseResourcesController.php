<?php

/**
 * Created by github@WageeshaR
 * Date: 26 Jan 2023
 */

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseResource;
use App\Models\SMContent;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
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
        $tw_content = SMContent::where('course_id', $course->id)
            ->where('lecture_id', SiteHelpers::encrypt_decrypt($lecture_slug, 'd'))
            ->where('sm_type', 'tw')->get();
        $fb_content = SMContent::where('course_id', $course->id)
            ->where('lecture_id', SiteHelpers::encrypt_decrypt($lecture_slug, 'd'))
            ->where('sm_type', 'fb')->get();
        return view('site.course.feed.resources',
                array(
                    'course' => $course,
                    'discussion' => $discussion,
                    'publications' => $res['pubs'],
                    'data' => $res['data'],
                    'quizzes' => $res['quiz'],
                    'video_footage' => $res['vids'],
                    'other' => $res['othr'],
                    'tw_content' => $tw_content,
                    'fb_content' => $fb_content
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
                'other' => $res['othr'],
                'lecs' => $res['lecs']
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
        $resource->authors = $request->{$res.'_authors'};
        $resource->publisher = $request->{$res.'_publisher'};
        $resource->summary = $request->{$res.'_summary'};
        $resource->url = $request->{$res.'_url'};
        $resource->lecture_id = $request->{$res.'_lecture'};
        if ($request->file($res.'_file')) {
            $name = $request->file($res.'_file')->getClientOriginalName();
//            $name = preg_replace('/\s+/', '_', $name);
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
        $lectures = DB::table('curriculum_lectures_quiz as clq')
                        ->select('clq.*')
                        ->join('curriculum_sections as cs', 'cs.section_id', '=', 'clq.section_id')
                        ->where('cs.course_id', $course_id)->get();
        $publications = CourseResource::where('resource_type', 'pubs')->where('course_id', $course_id)->get();
        $data = CourseResource::where('resource_type', 'data')->where('course_id', $course_id)->get();
        $quizzes = CourseResource::where('resource_type', 'quiz')->where('course_id', $course_id)->get();
        $video_footage = CourseResource::where('resource_type', 'vids')->where('course_id', $course_id)->get();
        $other = CourseResource::where('resource_type', 'othr')->where('course_id', $course_id)->get();
        return array("pubs" => $publications, "data" => $data, "quiz" => $quizzes, "vids" => $video_footage, "othr" => $other, 'lecs' => $lectures);
    }

    /**
     * Downloads a file from request
     * @param string $course_id
     * @param string $file_name
     * @param Request $request
     */
    public function downloadFile($course_id = '', $file_name = '', Request $request) {
        $file_path = 'course_resources/' . $course_id . '/' . $file_name;
        $headers = array( 'Content-Type : ' . mime_content_type(Storage::disk('public')->path($file_path)));
        return Storage::disk('public')->download($file_path, $file_name, $headers);
    }

    /**
     * @param string $course_id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSMContentBackend($course_id = '', Request $request) {
        $course = Course::find($course_id);
        $lecs = DB::table('curriculum_lectures_quiz as clq')
            ->select('clq.*')
            ->join('curriculum_sections as cs', 'cs.section_id', '=', 'clq.section_id')
            ->where('cs.course_id', $course_id)->get();
        $tw_content = SMContent::where('sm_type', 'tw')->where('course_id', $course_id)->get();
        $fb_content = SMContent::where('sm_type', 'fb')->where('course_id', $course_id)->get();
        return view('instructor.course.resources.smcontent', compact('course', 'tw_content', 'fb_content', 'lecs'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveSMContent(Request $request) {
        $res = $request->sm_type;
        if ($request->{$res.'_sm_id'}) {
            $sm_content = SMContent::find($request->{$res.'_sm_id'});
        }
        else {
            $sm_content = new SMContent();
        }
        $sm_content->course_id = $request->course_id;
        $sm_content->sm_type = $res;
        $sm_content->title = $request->{$res.'_title'};
        $sm_content->url = $request->{$res.'_url'};
        $sm_content->is_hashtag = $request->{$res.'_is_hashtag'} == 'on' ? 1 : 0;
        $sm_content->lecture_id = $request->{$res.'_lecture'};
        $sm_content->save();
        $return_url = 'instructor-course-sm-content/'.$request->course_id;
        return redirect($return_url)->with('status', "Success");
    }

    /**
     * @param $course_id
     * @param $resource_id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteSMContent($course_id, $resource_id, Request $request) {
        SMContent::destroy($resource_id);
        $return_url = 'instructor-course-sm-content/'.$course_id;
        return redirect($return_url)->with('status', "Success");
    }

    public function accessRequest($course_id = '', $access_type = '', Request $request) {
        $course = Course::find($course_id);
        return response()->json($course);
    }
}