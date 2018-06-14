<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
        $this->middleware('auth');
        if (Auth::user()) {
            return view('User.displayuser');
        } else {
            return redirect('/home')->with('error', 'you have unsufficient rights.');
        }
    }

    public function show(Request $request) {
        
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

        $users = User::select('*','tbl_user_role.st_role_name')->leftjoin('tbl_user_role','tbl_user_role.id','users.role_id')->get();
        
        $userData = [];
        if ($users->count() > 0) {
            foreach ($users as $key=>$user) {
                $userData[$key] = [
                    'id'   => $user['id'],
                    'name'  => $user['name'],
                    'email'  => $user['email'],
                    'role_name' => $user['st_role_name'],
                    'md5_in_user_id'   => md5($user['id']),
                ];
            }
        }
        $ajaxdata = [
                "FLAG" => 1,
                "recordsTotal" => intval($users->count()), // total number of records
                "recordsFiltered" => intval($users->count()), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $userData   // total data array
            ];
        return json_encode($ajaxdata);
    }
}
