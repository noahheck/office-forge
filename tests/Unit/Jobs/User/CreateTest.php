<?php

namespace Tests\Unit\Jobs\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Mocks\Hasher;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatingUserAddsToDatabase()
    {
        $job = new \App\Jobs\User\Create(
            'Noah Heck',
            'noah@example.com',
            'America/Denver',
            'Developer',
            'some kind of a long password',
            true,
            true,
            true
        );

        $hasher = new Hasher();

        $job->handle($hasher);

        $this->assertEquals('some kind of a long password', $hasher->getProvidedString());

        $this->assertDatabaseHas('users', [
            'name' => 'Noah Heck',
            'email' => 'noah@example.com',
            'timezone' => 'America/Denver',
            'active' => '1',
            'administrator' => '1',
            'system_administrator' => '1',
        ]);

        $user = $job->getUser();

        $this->assertEquals('Noah Heck', $user->name);
    }
}
