<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\EmailChanged;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch(route('profile.update'), [
                'name' => 'New Name',
                'email' => 'new@example.com',
                'current_password' => 'password',
            ])
            ->assertRedirect(route('profile.edit'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);

        Notification::assertSentOnDemand(EmailChanged::class);
    }
}
