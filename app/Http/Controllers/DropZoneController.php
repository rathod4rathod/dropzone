<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\DropZone;
use Illuminate\Support\Facades\Mail;
//use App\Http\Requests;
//use App\Http\Requests\Request;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Http\FormRequest;




class DropZoneController extends Controller {

    public function index() {
        $dataList = DropZone::all();

        return view('dropZone.index', compact('dataList'));
    }

    public function store(Request $request) {
        //   dd($request);
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                try {
                    $file = $request->file('file');
                    $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                    $filePath = '/var/www/html/demo/public/dropzoneImage';
                    $request->file('file')->move($filePath, $name);
                    $dropZone = new DropZone();
                    $dropZone->image = $name;
                    $dropZone->save();
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    
                }
            }
        }
    }

    public function destroy($id) {   //For Deleting Users
//        dd($id);
        $dropZone = DropZone::find($id); // Can chain this line with the next one
        $dropZone->delete($id);
        if($dropZone){
        return response()->json([
                'success' => 'Record has been deleted successfully!'
        ]);
        }
        else{
            return response()->json([
                'success' => 'Record has been deleted successfully!'
        ]);
        }
    }
     public function dropzoneImageDelete(Request $request) {   //For Deleting Users
        $id = $request->id();
       // dd($id);
        DropZone::destroy($id);
        return response()->json([
                'success' => 'Record has been deleted successfully!'
        ]);
    }

}
