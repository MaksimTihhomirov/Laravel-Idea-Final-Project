<?php

namespace Tests\Feature;

use App\IdeaStatus;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_idea_belongs_to_user(): void
    {
        $idea = Idea::factory()->create();

        $this->assertInstanceOf(User::class, $idea->user);
    }

    public function test_idea_has_pending_status(): void
    {
        $idea = Idea::factory()->create();

        $this->assertEquals(IdeaStatus::PENDING, $idea->status);
    }

    public function test_idea_can_have_steps(): void
    {
        $idea = Idea::factory()->create();

        $idea->steps()->create([
            'description' => 'First step',
        ]);

        $this->assertCount(1, $idea->steps);
    }
}
