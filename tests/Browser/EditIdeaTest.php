<?php

use App\Models\Idea;
use App\Models\User;

it('updates an existing idea', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $idea = Idea::factory()->for($user)->create();

    visit('/ideas/' . $idea->id)
        ->click('[data-test="edit-idea-button"]')
        ->fill('title', 'Updated Idea')
        ->fill('description', 'Updated description')
        ->click('[data-test="button-status-completed"]')
        ->press('Save Changes')
        ->assertSee('Updated Idea');

    $this->assertDatabaseHas('ideas', [
        'id' => $idea->id,
        'title' => 'Updated Idea',
        'description' => 'Updated description',
        'status' => 'completed',
    ]);
});