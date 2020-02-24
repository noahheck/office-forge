<?php

namespace App\Jobs\FileType\Form;

use App\FileType;
use App\FileType\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable, Queueable;

    private $fileType;
    private $name;

    private $form;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, $name)
    {
        $this->fileType = $fileType;
        $this->name = $name;
    }

    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $form = new Form;
        $form->file_type_id = $this->fileType->id;
        $form->name = $this->name;
        $form->active = true;
        $form->order = $this->fileType->forms->max('order') + 1;

        $form->save();

        $this->form = $form;
    }
}
