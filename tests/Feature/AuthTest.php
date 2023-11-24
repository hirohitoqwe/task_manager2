<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private $token;

    public function setUp(): void
    {
        parent::setUp();
        User::factory()->count(1)->create();
        $this->token = JWTAuth::fromUser(User::first());
    }

    /**
     * A basic feature test example.
     */
    public function testMeEndpoint()
    {
        $response = $this->post('/api/auth/me', [],
            ['Authorization' => 'Bearer ' . $this->token]
        );
        $this->assertEquals(json_decode($response->getContent())->email, User::first()->email);
        $response->assertStatus(Response::HTTP_OK);
    }
}
