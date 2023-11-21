<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TaskEndpointTest extends TestCase
{
    use RefreshDatabase;

    private const TEST_STRING = 'test';
    private const TEST_DESC = 'description';

    /**
     * A basic test example.
     */

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function testGetEndpoint(): void
    {
        $response = $this->get('/api/task');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testCreateEndpoint(): void
    {
        $response = $this->post('/api/task/create', [
            'title' => self::TEST_STRING,
            'description' => self::TEST_DESC
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testFailedCreateEndpoint(): void
    {
        $response = $this->post('/api/task/create', [
            'random_title' => self::TEST_STRING,
            'description' => self::TEST_DESC
        ]);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testGetByIdEndpoint()
    {
        Task::factory()->create();
        $model = Task::all()->last();
        $response = $this->get('/api/task/' . $model->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($model->title, json_decode($response->getContent())->title);
    }

    public function testFailedGetByIdEndpoint()
    {
        Task::factory()->create();
        $model = Task::all()->last();
        $response = $this->get('/api/task/' . ($model->id + 1));
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function testDeleteEndpoint()
    {
        Task::factory()->create();
        $count = Task::all()->count();
        $modelForDelete = Task::all()->last();
        $response = $this->delete('/api/task/' . $modelForDelete->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($count - 1, Task::all()->count());
    }
}
