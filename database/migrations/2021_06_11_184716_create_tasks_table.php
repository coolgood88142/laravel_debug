<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Task; 

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->boolean('completed')->default(0);
            $table->timestamps();
        });
    }

    public function test_that_a_task_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        Task::factory()->times(5)->create(); // create 5 tasks using the factory setup above
        $id_to_be_deleted = random_int(1, 5); // select a random task
        $this->delete("/api/tasks/$id_to_be_deleted/"); // send a request to delete it
        $this->assertDatabaseMissing('tasks', ['id' => $id_to_be_deleted]); // assert that the task deleted previouly does not exist in the database anymore.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
