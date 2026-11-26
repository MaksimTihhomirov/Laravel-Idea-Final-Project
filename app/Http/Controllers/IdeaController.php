<?php

namespace App\Http\Controllers;

use App\IdeaStatus;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
        if (! Auth::check()) {
            return view('welcome');
        }

        $user = Auth::user();

        $validated = $request->validate([
            'status' => ['nullable', Rule::enum(IdeaStatus::class)],
        ]);

        $status = $validated['status'] ?? null;

        $ideas = $user->ideas()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();

        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCounts' => Idea::statusCounts($user),
            'status' => $status,
        ]);
    }
}