<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Support\Facades\Auth;

class StepController extends Controller
{
    public function update(Step $step)
    {
        abort_unless(Auth::user()->is($step->idea->user), 403);

        $step->update([
            'completed' => ! $step->completed,
        ]);

        return back();
    }
}