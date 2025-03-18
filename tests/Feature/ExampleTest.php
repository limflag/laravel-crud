<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_if_application_redirects_guest_to_login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
