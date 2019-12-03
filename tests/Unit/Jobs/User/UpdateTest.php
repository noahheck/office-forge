<?php

namespace Tests\Unit\Jobs\User;

use App\Jobs\User\Update;
use App\User;
use App\Utility\RandomColorGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Mocks\Hasher;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUpdatingUserUpdatesDatabase()
    {
        $user = new User;

        $user->name = 'Noah Heck';
        $user->email = 'noah@example.com';
        $user->timezone = 'America/Denver';
        $user->job_title = 'Developer';
        $user->password = 'password';
        $user->color = RandomColorGenerator::generateHex(RandomColorGenerator::COLOR_DARK);
        $user->active = true;
        $user->administrator = true;
        $user->system_administrator = true;

        $user->save();


        $job = new Update(
            $user,
            'Noah Heckington',
            'noah.heckington@example.com',
            'America/LosAngeles',
            'Developer at heart',
            true,
            false,
            false,
            'longer password'
        );

        $hasher = new Hasher();

        $job->handle($hasher);

        $this->assertEquals('longer password', $hasher->getProvidedString());

        $this->assertDatabaseHas('users', [
            'name' => 'Noah Heckington',
            'email' => 'noah.heckington@example.com',
            'timezone' => 'America/LosAngeles',
            'active' => '1',
            'administrator' => '0',
            'system_administrator' => '0',
        ]);
    }
}
