<?php
/**
 * PHP Version 7.1.7-1
 * Functions for user roles
 *
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $users = Role::where('id', '<>', null)->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->paginate($paginate_count);
        }
        else {
            $roles = Role::where('id', '<>', null)->paginate($paginate_count);
        }

        return view('admin.roles.index', compact('roles'));
    }

    public function getForm($role_id='', Request $request)
    {
        if($role_id) {
            $role = Role::find($role_id);
        }else{
            $role = $this->getColumnTable('roles');
        }
        return view('admin.roles.form', compact('role'));
    }

    public function saveRole($role_id='', Request $request)
    {
        $success_message = "Role saved successfully";
        return $this->return_output('flash', 'success', $success_message, 'admin/roles', '200');
    }
}