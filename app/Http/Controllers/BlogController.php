<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
use SiteHelpers;
use Crypt;
use URL;
use Session;

class BlogController extends Controller
{
    /**
     * Function to display the blogs for instructor and student
     *
     * @param array $request All input values from form
     *
     * @return contents to display in blogs page
     */
    public function index(Request $request)
    {
        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $blogs = Blog::where('blog_title', 'LIKE', '%' . $search . '%')
                ->paginate($paginate_count);
        }
        else {
            $blogs = Blog::paginate($paginate_count);
        }

        return view('blogs.index', compact('blogs'));
    }

    public function getForm($blog_id='', Request $request)
    {
        if($blog_id) {
            $blog = Blog::find($blog_id);
        }else{
            $blog = $this->getColumnTable('blogs');
        }
        return view('blogs.form', compact('blog'));
    }

    public function blogsList($course_slug = '', $lecture_slug = '', Request $request)
    {
        $paginate_count = 10;
        $blogs = DB::table('blogs')
            ->select('blogs.*', 'curriculum_lectures_quiz.title as lecture', 'courses.course_slug as course_slug')
            ->join('curriculum_lectures_quiz', 'curriculum_lectures_quiz.lecture_quiz_id', '=', 'blogs.lecture_quiz_id')
            ->join('curriculum_sections', 'curriculum_sections.section_id', '=', 'curriculum_lectures_quiz.section_id')
            ->join('courses', 'courses.id', '=', 'curriculum_sections.course_id')
            ->where('blogs.lecture_quiz_id', SiteHelpers::encrypt_decrypt($lecture_slug, 'd'))->paginate($paginate_count);
        return view('blogs.list', compact('blogs'));
    }

    public function blogRead($blog_id = '', Request $request)
    {
        $content = Blog::find($blog_id);
        return view('blogs.read', compact('content'));
    }
}