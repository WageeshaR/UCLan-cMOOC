<?php
/**
 * PHP Version 7.1.7-1
 * Functions for institutions
 *
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Role;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstitutionController extends Controller
{
    /**
     * Function to display the dashboard contents for admin
     *
     * @param array $request All input values from form
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $institutions = Institution::where('id', '<>', null)->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('type', 'LIKE', '%' . $search . '%')
                        ->orWhere('contact', 'LIKE', '%' . $search . '%');
                })
                ->paginate($paginate_count);
        }
        else {
            $institutions = Institution::where('id', '<>', null)->paginate($paginate_count);
        }

        return view('admin.institution.index', compact('institutions'));
    }

    public function getForm($institution_id='', Request $request)
    {
        if($institution_id) {
            $institution = Institution::find($institution_id);
        }else{
            $institution = $this->getColumnTable('institution');
        }
        return view('admin.institution.form', compact('institution'));
    }

    public function saveInstitution(Request $request)
    {
        $success_message = "Institution data is saved successfully";
        return $this->return_output('flash', 'success', $success_message, 'admin/institutions', '200');
    }

}
