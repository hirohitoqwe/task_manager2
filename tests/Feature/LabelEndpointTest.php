<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LabelEndpointTest extends TestCase
{
    private const TEST_NAME = 'label_test';

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    /**
     * A basic feature test example.
     */
    public function testCreateLabel(): void
    {
        $response = $this->post('/api/label/create', [
            'name' => self::TEST_NAME,
            'color' => 'test'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }
}
