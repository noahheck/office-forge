<?php

namespace Tests\Unit\Jobs\Project;

use App\Jobs\Activity\Update;
use App\Activity;
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
    public function testUpdatingProjectUpdatesDatabase()
    {
        $project = new Project();
        $project->name = 'Add tests';
        $project->due_date = Carbon::now();
        $project->created_by = 17;

        $project->save();

        $job = new Update(
            $project,
            'Add and update tests',
            '12/03/2019',
            '14',
            true,
            'Some details about the project and whatnot'
        );

        $job->handle();

        $this->assertDatabaseHas('projects', [
            'name' => 'Add and update tests',
            'details' => 'Some details about the project and whatnot',
            'completed' => '1',
            'owner_id' => '14',
        ]);
    }
}
