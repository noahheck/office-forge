<?php

namespace Tests\Unit\Jobs\EditorImage;

use App\Jobs\EditorImage\Upload;
use App\Activity;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
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
            $file,
            Project::class,
            null,
            'abc123',
            $user
        );

        app()->call([$job, 'handle']);

        $editorImage = $job->getEditorImage();

        $path = "/editor-images/" . $editorImage->filename;

        Storage::assertExists($path);

        $this->assertEquals('image/jpeg', $editorImage->type);
        $this->assertEquals('headshot.jpg', $editorImage->original_filename);
        $this->assertEquals($user->id, $editorImage->uploaded_by);
        $this->assertEquals('abc123', $editorImage->resource_temp_id);
    }
}
