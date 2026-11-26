<?php

namespace App\Http\Controllers;

use App\Actions\CreateIdea;
use App\IdeaStatus;
use App\Http\Requests\StoreIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function store(StoreIdeaRequest $request, CreateIdea $action)
    {
        $action->handle($request->validated(), $request->user());

        return redirect('/ideas')
            ->with('success', 'Idea created successfully!');
    }

    public function show(Idea $idea)
    {
        abort_unless(Auth::user()->is($idea->user), 403);

        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    public function destroy(Idea $idea)
    {
        abort_unless(Auth::user()->is($idea->user), 403);

        $imagePath = $idea->image_path;

        $idea->delete();

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect('/ideas')
            ->with('success', 'Idea deleted successfully!');
    }
}