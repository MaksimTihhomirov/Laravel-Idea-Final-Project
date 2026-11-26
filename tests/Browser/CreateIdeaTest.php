<?php

use App\Models\User;

it('creates a new idea', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    visit('/ideas')
        ->click('[data-test="create-idea-button"]')
        ->fill('title', 'Some Example Title')
        ->click('[data-test="button-status-completed"]')
        ->fill('description', 'An example description')
        ->press('Create Idea')
        ->assertPathIs('/ideas')
        ->assertSee('Some Example Title');

    $this->assertDatabaseHas('ideas', [
        'user_id' => $user->id,
        'title' => 'Some Example Title',
        'description' => 'An example description',
        'status' => 'completed',
    ]);
});
