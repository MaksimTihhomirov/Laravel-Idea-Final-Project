<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return view('welcome');
        }

        return view('ideas.index', [
            'ideas' => Auth::user()->ideas()->latest()->get(),
        ]);
    }
}