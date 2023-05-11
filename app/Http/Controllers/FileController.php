<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\File;
=======
>>>>>>> 4494bb2 (Add users and scams sections for admin)
use Illuminate\Http\Request;

class FileController extends Controller
{
<<<<<<< HEAD
    public function upload (Request $request)
    {
        //get the file id request
        $fileId = $request->fileId;

        $uploadedFile = File::create([
            'id'=>$fileId,
        ]);
    }
=======
    //
>>>>>>> 4494bb2 (Add users and scams sections for admin)
}
