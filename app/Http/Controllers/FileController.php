<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload (Request $request)
    {
        $validated = $request->validate([
            'file_id' => 'required|file',
        ]);
    
        $uploadedFile = $validated['file_id'];
    
        $path = $uploadedFile->store('scam_files', 'public');
    
        $file = File::create([
            'name' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'scam_id' => null,
        ]);
    
        return Inertia::render('UserDash', [
            'file_id' => $file->id,
        ]);
    
    }
}
