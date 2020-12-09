<?php

namespace App\Jobs\File;

use App\File;
use App\FileType;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $fileType;
    private $name;
    private $accessLocks;
    private $creatingUser;

    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, $name, $accessLocks, User $creatingUser)
    {
        $this->fileType = $fileType;
        $this->name = $name;
        $this->accessLocks = $accessLocks;
        $this->creatingUser = $creatingUser;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = new File;
        $file->file_type_id = $this->fileType->id;
        $file->name = $this->name;
        $file->created_by = $this->creatingUser->id;

        $file->save();

        $file->accessLocks()->sync($this->accessLocks);

        // Add empty entry for each FileType Form Field for this new File
        $allFields = [];

        $this->fileType->loadMissing('forms', 'forms.fields');

        foreach ($this->fileType->forms as $form) {
            foreach ($form->fields as $field) {
                $allFields[] = [
                    'file_id' => $file->id,
                    'file_type_form_field_id' => $field->id,
                ];
            }
        }

        $file->formFieldValues()->createMany($allFields);

        $this->file = $file;
    }
}
