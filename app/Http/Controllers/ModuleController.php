<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Module;

class ModuleController extends Controller
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
            return view('Module.display');
        } else {
            return redirect('/home')->with('error', 'you have unsufficient rights.');
        }
    }

    public function processModule(Request $request) {
        
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

        $modules = Module::all();

        $moduleData = [];
        if ($modules->count() > 0) {
            foreach ($modules as $key=>$module) {
                $moduleData[$key] = [
                    'id'   => $module['id'],
                    'st_module_name'  => $module['st_module_name'],
                    'md5_in_module_id'   => md5($module['id']),
                ];
            }
        }
        $ajaxdata = [
                "FLAG" => 1,
                "recordsTotal" => intval($modules->count()), // total number of records
                "recordsFiltered" => intval($modules->count()), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $moduleData   // total data array
            ];
        return json_encode($ajaxdata);
    }

    public function createModule() 
    {
        if (Auth::user()) {
            return view('Module.create');
        } else {
            return redirect('/home')->with('error', 'you have unsufficient rights.');
        }
    }

    public function saveModule(Request $request) {

        extract($_POST, EXTR_PREFIX_SAME, "");

        try {
            DB::beginTransaction();
            $moduleData = new Module;
            $moduleData->st_module_name = $txtModuleName;
            //$userRole->in_role_status = $selectRoleStatus;
            // database queries here
            if($moduleData->save()) {
                $lastInsertModule = $moduleData->id;
                DB::commit();
                return redirect('modules')->with('success', 'Module added successfully.');
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

}
