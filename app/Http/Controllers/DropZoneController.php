<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\DropZone;
use Illuminate\Support\Facades\Mail;
//use App\Http\Requests;
//use App\Http\Requests\Request;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Http\FormRequest;



 
class DropZoneController extends Controller
{
    public function index()
    {
        return view('dropZone.index');
    }

    public function store(Request $request)
    {
     //   dd($request);
        if ($request->hasFile('file')) {
        if($request->file('file')->isValid()) {
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
}