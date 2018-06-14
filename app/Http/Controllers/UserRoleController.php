<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Module;

class UserRoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()) {
            return view('Role.displayRole');
        } else {
            return redirect('/home')->with('error', 'you have unsufficient rights.');
        }
    }

    public function processUserRole(Request $request) {
        
        $ajaxdata['FLAG']            = 0;
        $ajaxdata['recordsTotal']    = 0;
        $ajaxdata['recordsFiltered'] = 0;
        $ajaxdata['data']            = 0;

        extract($_POST, EXTR_PREFIX_SAME, "");
        $columnNumber = $order[0]['column'];
        $columnName   = $columns[$columnNumber]['data'];
        $dir          = $order[0]['dir'];
        $limit        = $length;
        $offset       = $start;
        $search       = $search['value'];
        $status       = 1;

        $conditions = [];

        $roles = UserRole::all();
       
        $rolesData = [];
        if ($roles->count() > 0) {
            foreach ($roles as $key=>$role) {
                $rolesData[$key] = [
                    'id'            =>$role['id'],
                    'st_role_name'  => $role['st_role_name'],
                    'in_role_status'  => $role['in_role_status'],
                    'md5_in_role_id'   => md5($role['id']),
                ];
            }
        }
        $ajaxdata = [
                "FLAG" => 1,
                "recordsTotal" => intval($roles->count()), // total number of records
                "recordsFiltered" => intval($roles->count()), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $rolesData   // total data array
            ];
        return json_encode($ajaxdata);
    }

    public function createUserRole(Request $request) 
    {
        if (Auth::user()) {

            return view('Role.createRole');
        } else {
            return redirect('/home')->with('error', 'you have unsufficient rights.');
        }
    }

    public function saveUserRole(Request $request) {

        extract($_POST, EXTR_PREFIX_SAME, "");

        try {
            DB::beginTransaction();
            $userRoleData = new UserRole;
            $userRoleData->st_role_name = $txtRoleName;
            //$userRole->in_role_status = $selectRoleStatus;
            // database queries here
            if($userRoleData->save()) {
                $lastInsertRole = $userRoleData->id;
                DB::commit();
                return redirect('roles')->with('success', 'User role added successfully');
            } else {
                DB::rollBack();
                return false;
            }

        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            return false;
        }

        //return redirect('roles')->with('success', 'User role added successfully');
    }

    public function editUserRole(Request $request, $id) {
        if (Auth::user()) {
            $role = UserRole::where(DB::RAW('md5(id)'), $id)->first();
            $moduleLists = Module::all();
            
            if ($role) {
                $data['role'] = $role;
                return view('Role.createRole', compact('data'));
            } else {
                return redirect('roles')->with('success', 'User role not found.');
            }
            return view('Role.editRole');
        } else {
            return redirect('/home')->with('error', 'you have unsufficient rights.');
        }
    }

    public function processEditUserRole(Request $request, $id) {

        extract($_POST, EXTR_PREFIX_SAME, "");
        $role = UserRole::where(DB::RAW('md5(id)'), $id)->first();
        if ($role) {
            $role->st_role_name = $txtRoleName;
            $role->in_role_status = $selectRoleStatus;
            $role->update();
            return redirect('roles')->with('success', 'User role updated.');
        }
    }
}