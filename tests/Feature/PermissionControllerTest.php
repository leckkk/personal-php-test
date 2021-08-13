<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFirst()
    {
        $response = $this->user(1)->get('/api/one');

        $this->printResponse($response);

        $response->assertStatus(200);
    }
}
