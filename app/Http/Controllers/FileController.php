<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload (Request $request)
    {
        //get the file id request
        $fileId = $request->fileId;

        $uploadedFile = File::create([
            'id'=>$fileId,
        ]);
    }
}
