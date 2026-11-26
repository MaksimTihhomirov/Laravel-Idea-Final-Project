<?php

namespace Tests\Feature;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class IdeaPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_manage_idea(): void
    {
        $idea = Idea::factory()->create();

        $gate = Gate::forUser($idea->user);

        $this->assertTrue($gate->allows('view', $idea));
        $this->assertTrue($gate->allows('update', $idea));
        $this->assertTrue($gate->allows('delete', $idea));
    }

    public function test_policy_restricts_access_to_owner(): void
    {
        $idea = Idea::factory()->create();
        $user = User::factory()->create();

        $gate = Gate::forUser($user);

        $this->assertFalse($gate->allows('view', $idea));
        $this->assertFalse($gate->allows('update', $idea));
        $this->assertFalse($gate->allows('delete', $idea));
    }
}