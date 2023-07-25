<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Scam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ScamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $scams = Scam::withTrashed()
            ->with('user')
            ->with('file')
            ->when($request->search_term, function ($query, $search_term) {
                $query->where('contact', 'LIKE', '%' . $search_term . '%');
            })
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
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'payment' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'activity' => ['nullable', 'string', 'max:255'],
            'platform' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable'],
        ]);

        $user = Auth::user();
        //Set the file name to null if no file is uploaded
        $file_name = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->store('scam_files', 'public');
        }

        Scam::create([
            'contact' => $request->contact,
            'content' => $request->content,
            'payment' => $request->payment,
            'country' => $request->country,
            'platform' => $request->platform,
            'activity' => $request->activity,
            'user_id' => $user->id,
            'file' => $file_name,
        ]);

        return redirect()->route('dashboard');
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
    public function destroy(Scam $scam)
    {
        //Delete scam
        $scam->delete();

        return to_route('dashboard');
    }
}
