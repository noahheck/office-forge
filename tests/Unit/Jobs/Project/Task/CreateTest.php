<?php

namespace Tests\Unit\Jobs\Project\Task;

use App\Jobs\Activity\Task\Create;
use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatingProjectAddsToDatabase()
    {
        $project = new Project();
        $project->id = 17;

        $creator = new User();
        $creator->id = 2;

        $job = new Create(
            $project,
            "Add a test for Creating Tasks",
            "12/17/2019",
            2,
            "Get the tests into place and make sure to...",
            $creator,
            '867-5309'
        );

        $job->handle();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Add a test for Creating Tasks',
            'created_by' => '2',
            'assigned_to' => '2',
        ]);

        $task = $job->getTask();

        $this->assertEquals("Add a test for Creating Tasks", $task->title);
    }
}
