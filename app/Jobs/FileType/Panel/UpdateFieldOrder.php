<?php

namespace App\Jobs\FileType\Panel;

use App\FileType;
use App\FileType\Panel;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateFieldOrder
{
    use Dispatchable, Queueable;

    private $fileType;
    private $panel;
    private $orderedFields;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, Panel $panel, $orderedFields)
    {
        $this->fileType = $fileType;
        $this->panel = $panel;
        $this->orderedFields = $orderedFields;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fieldOrderMap = array_flip($this->orderedFields);

        $fields = $this->panel->fields;

        foreach ($fields as $field) {

            if (!array_key_exists($field->id, $fieldOrderMap)) {

                continue;
            }

            $field->pivot->order = $fieldOrderMap[$field->id] + 1;
            $field->pivot->save();
        }
    }
}
