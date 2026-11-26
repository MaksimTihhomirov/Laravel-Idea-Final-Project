<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('logs in and logs out a user', function () {
    User::factory()->create([
        'email' => 'john@example.com',
        'password' => Hash::make('Password123!'),
    ]);

    visit('/login')
        ->fill('email', 'john@example.com')
        ->fill('password', 'Password123!')
        ->press('form[action="/login"] button')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    visit('/')
        ->press('Log Out')
        ->assertPathIs('/');

    $this->assertGuest();
});
