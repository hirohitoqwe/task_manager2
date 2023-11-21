<?php

namespace Tests\Feature;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LabelEndpointTest extends TestCase
{

    use RefreshDatabase;

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

    public function testDeleteLabel()
    {
        Label::factory()->create();
        $count = Label::all()->count();
        $response = $this->delete('/api/label/' . Label::all()->last()->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(Label::all()->count(), $count - 1);
    }

}
