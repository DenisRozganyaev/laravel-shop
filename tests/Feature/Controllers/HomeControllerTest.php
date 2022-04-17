<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_index_with_auth_user()
    {
        $user = User::factory(1)->create()->first();

        $response = $this->actingAs($user, 'web')->get('/');

        $response->assertStatus(200);
        $response->assertSee('You are logged in!');
    }

    public function test_index_when_user_does_not_auth()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect(url('login'));
    }
}
