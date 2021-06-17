<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
    }

    /** @test */
    public function can_create_project()
    {
        $response = $this
            ->actingAs(User::first())
            ->post(route('projects.store'), [
                '_token' => csrf_token(),
                'title' => 'Test title'
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseCount('projects', 1);
    }

    /** @test */
    public function can_delete_project()
    {
        $user = User::first();

        $response = $this
            ->actingAs($user)
            ->post(route('projects.store'), [
                '_token' => csrf_token(),
                'title' => 'Test title'
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseCount('projects', 1);

        $response = $this
            ->actingAs($user)
            ->delete(route('projects.delete', Project::first()));

        $response->assertStatus(302);
        $this->assertDatabaseCount('projects', 0);
    }
}
