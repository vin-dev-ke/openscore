<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index ()
    {
        $role = Auth::user()->getRoleNames()->first();
        return Inertia::render('Dashboard', [
            'role'=>$role
        ]);
    }
}
