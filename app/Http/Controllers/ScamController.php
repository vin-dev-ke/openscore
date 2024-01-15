<?php

namespace App\Http\Controllers;

use App\Models\Scam;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ScamController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $scams = Scam::withTrashed()
            ->with('user')
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
            'contact' => ['required', 'string', 'max:255'],
            'payment' => ['nullable', 'string', 'max:255'],
            'scammer_name' => ['nullable', 'string', 'max:255'],
            'amount' => ['nullable', 'numeric'],
            'scam_activity' => ['nullable', 'string', 'max:255'],
            'platform' => ['nullable', 'string', 'max:255'],
            'comments' => ['nullable', 'text'],
            'country' => ['nullable', 'string', 'max:255'],
            'file_id' => ['nullable',],
        ]);

        $user = Auth::user();

        // Set the file_id to null if no file is uploaded
        $file_id = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileModel = File::create(['path' => $file->store('scam_files', 'public')]);
            $file_id = $fileModel->id;
        }

        Scam::create([
            'contact' => $request->contact,
            'payment' => $request->payment,
            'scammer_name' => $request->scammer_name,
            'amount' => $request->amount,
            'scam_activity' => $request->scam_activity,
            'platform' => $request->platform,
            'comments' => $request->comments,
            'country' => $request->country,
            'file_id' => $file_id,
            'user_id' => $user->id,
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

    // public function share(Scam $scam)
    // {

    //     // Generate the URL for the scam post using the 'url' helper
    //     $scamUrl = url("/scams/{$scam->id}");

    //     $share_page = \Share::page($scamUrl, $scam->name);
    // }
}
