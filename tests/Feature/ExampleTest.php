<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function testRespoceStruct()
    {
        $this->get('http://ajrnii.com/api/v1/settings')
            ->assertStatus(200)
            ->assertJson([
                'status'=>true,
                'message',
                'data'
            ]);

    }
}
