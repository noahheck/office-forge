<?php

namespace App\Jobs\FileType\Forms;

use App\FileType;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $fileType;
    private $orderedForms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, $orderedForms)
    {
        $this->fileType = $fileType;
        $this->orderedForms = $orderedForms;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $formOrderMap = array_flip($this->orderedForms);

        $forms = $this->fileType->forms;

        foreach ($forms as $form) {

            if (!array_key_exists($form->id, $formOrderMap)) {

                continue;
            }

            $form->order = $formOrderMap[$form->id] + 1;
            $form->save();
        }
    }
}
