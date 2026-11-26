<?php

namespace App\Http\Controllers;

use App\Notifications\EmailChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'current_password' => ['required', 'current_password'],
            'password' => ['nullable', Password::defaults()],
        ]);

        $oldEmail = $user->email;

        $user->name = $attributes['name'];
        $user->email = $attributes['email'];

        if ($oldEmail !== $user->email) {
            $user->email_verified_at = null;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($attributes['password']);
        }

        $user->save();

        $request->session()->regenerate();

        if ($oldEmail !== $user->email) {
            Notification::route('mail', $oldEmail)
                ->notify(new EmailChanged);
        }

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated!');
    }
}
