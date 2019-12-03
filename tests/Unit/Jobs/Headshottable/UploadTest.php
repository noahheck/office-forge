<?php

namespace Tests\Unit\Jobs\Headshottable;

use App\Jobs\Headshottable\Upload;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUploadRecordsEntryInDatabaseAndStoresFileOnDisk()
    {
        Storage::fake();

        $user = factory(User::class)->create();

        $file = UploadedFile::fake()->image('headshot.jpg');

        $job = new Upload(
            $user,
            $file,
            $user
        );

        app()->call([$job, 'handle']);

        $headshot1 = $job->getHeadShot();

        $path = "/headshots/" . $headshot1->filename;

        Storage::assertExists($path);

        $this->assertEquals('image/jpeg', $headshot1->type);
        $this->assertEquals('jpg', $headshot1->extension);
        $this->assertEquals('headshot.jpg', $headshot1->original_filename);
        $this->assertTrue($headshot1->current);

        $user->refresh();

        app()->call([$job, 'handle']);

        $headshot2 = $job->getHeadShot();

        $headshot1->refresh();

        $this->assertFalse($headshot1->current);
        $this->assertTrue($headshot2->current);
    }
}
