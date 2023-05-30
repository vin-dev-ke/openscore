<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Scam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ScamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $scams = Scam::withTrashed()
            ->with('user')
            ->when($request->search_term, function($query,$search_term){$query->where('contact', 'LIKE','%'.$search_term.'%');})
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return Inertia::render('Scam', [
            'scams' => $scams
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required','string','max:255'],
            'contact' => ['required','string','max:255'],
            'payment' => ['nullable','string','max:255'],
            'file_id' => ['nullable', 'file'],
          ]);
  
          $user = Auth::user();

          $newScam = new Scam();
          $newScam->contact = $validated['contact'];
          $newScam->content = $validated['content'];
          $newScam->payment = $validated['payment'];
          $newScam->user_id = $user->id;
          $newScam->save();
          
          // Save file records if a file is uploaded
          if ($request->hasFile('file_id')) {
              $file = $validated['file_id'];
              $filePath = $file->store('scam_files', 'public');
              $fileName = $file->getClientOriginalName();
          
              $newFile = new File();
              $newFile->name = $fileName;
              $newFile->path = $filePath;
              $newFile->scam_id = $newScam->id; // Assign the scam_id
              $newFile->save();
          }

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
