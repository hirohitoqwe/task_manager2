<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TaskEndpointTest extends TestCase
{
    private const TEST_STRING = 'test';
    private const TEST_DESC = 'description';

    /**
     * A basic test example.
     */

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

        $insertTask = Task::all()->last();
        $this->assertEquals(self::TEST_STRING, $insertTask->title);
        $this->assertEquals(self::TEST_DESC, $insertTask->description);
    }

    public function testGetByIdEndpoint()
    {
        $model = Task::all()->last();
        $response = $this->get('/api/task/' . $model->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($model->title, json_decode($response->getContent())->title);
    }

    public function testDeleteEndpoint()
    {
        $count = Task::all()->count();
        $modelForDelete = Task::all()->last();
        $response = $this->delete('/api/task/' . $modelForDelete->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($count - 1, Task::all()->count());
    }
}
