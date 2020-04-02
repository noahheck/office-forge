<?php

namespace Tests\Unit\Jobs\Project\Task;

use App\Jobs\Activity\Task\Update;
use App\Project\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testUpdatingTaskUpdatesDatabase()
    {
        $task = new Task();
        $task->project_id = 2;
        $task->title = "Add a test for Updating Tasks";
        $task->due_date = Carbon::now();
        $task->created_by = 2;

        $task->save();

        $job = new Update(
            $task,
            'Update the test for Updating Tasks',
            '12/17/2019',
            '2',
            false,
            'Some more details about updating the task test'
        );

        $job->handle();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Update the test for Updating Tasks',
            'assigned_to' => '2',
            'completed' => '0',
            'details' => 'Some more details about updating the task test',
        ]);
    }
}
