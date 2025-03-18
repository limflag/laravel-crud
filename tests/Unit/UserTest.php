<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_user()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'isAdmin' => false,
        ]);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    #[Test]
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();
        $user->update(['name' => 'Novo Nome']);

        $this->assertDatabaseHas('users', ['name' => 'Novo Nome']);
    }

    #[Test]
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();
        $user->delete();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
