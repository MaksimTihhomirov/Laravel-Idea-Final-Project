<?php

use App\Models\User;

it('registers a user', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@example.com')
        ->fill('password', 'Password123!')
        ->press('#register-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(User::where('email', 'john@example.com')->exists())
        ->toBeTrue();
});
