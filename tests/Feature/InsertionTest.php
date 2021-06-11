<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task; 

class InsertionTest extends TestCase
{
    public function test_that_a_task_can_be_added()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/tasks/create', [
            'name' => 'Write Article',
            'description' => 'Write and publish an article'
        ]);
        $response->assertStatus(201);
        $this->assertTrue(count(Task::all()) > 1);
    }

    public function test_that_a_task_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        Task::factory()->times(5)->create(); // create 5 tasks using the factory setup above
        $id_to_be_deleted = random_int(1, 5); // select a random task
        $this->delete("/api/tasks/$id_to_be_deleted/"); // send a request to delete it
        $this->assertDatabaseMissing('tasks', ['id' => $id_to_be_deleted]); // assert that the task deleted previouly does not exist in the database anymore.
    }
}
