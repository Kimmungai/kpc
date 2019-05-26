<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPurchasesList()
    {
        $response = $this->get('/purchases');

        $response->assertSeeTextInOrder(["Purchases","Department"]);

        $response->assertViewHasAll(['depts','purchases']);

        $response->assertStatus(200);
    }
}
