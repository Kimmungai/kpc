<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserRegistrationForm()
    {
        $response = $this->get('/user-registration');

        $response->assertSeeTextInOrder(["User registration","Save"]);

        $response->assertStatus(200);
    }
}
