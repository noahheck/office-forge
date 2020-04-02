<?php

namespace Tests\Unit\Jobs\Project;

use App\Jobs\Activity\Create;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatingProjectAddsToDatabase()
    {
        $creator = new User();
        $creator->id = 17;

        $job = new Create(
            'Add tests',
            '12/03/2019',
            '13',
            'Get the tests into place and then we can...',
            $creator,
            '123'
        );

        $job->handle();

        $this->assertDatabaseHas('projects', [
            'name' => 'Add tests',
            'created_by' => '17',
            'owner_id' => '13',
        ]);

        $project = $job->getProject();

        $this->assertEquals('Add tests', $project->name);
    }
}
