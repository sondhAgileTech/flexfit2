<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    function index(Request $request)
    {

        $ck = $request->get('CKEditorFuncNum');
        if ($request->hasFile('upload')) {     //uploadforckeditordefaultfilesubmitID
            $file = $request->file('upload');   //Image data taken from the contents of the request content
            $allowed_extensions = ["png", "jpg", "gif"]; //Allow pictures suffix
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                return 'Pictures only support the suffixpng,jpg,gif,Please check!';
            }
            $destinationPath = getenv('UPLOAD_FILE_PATH');  //Pictures stored path
            $extension = $file->getClientOriginalExtension();  //Get the file suffix
            $fileName = md5(time()) . '.' . $extension;  //Create a picture name
            $result = $file->move($destinationPath, $fileName); //Path to store pictures
            $url = getenv('FILE_URL') . '/' . $fileName; //Output picture website navigation path
            //echo $url;
            echo "<script>window.parent.CKEDITOR.tools.callFunction($ck, '$url', '');</script>";

        }
    }
}