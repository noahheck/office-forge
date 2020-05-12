<?php


namespace App\Document;


use App\File;
use App\FormDoc;
use App\User;

class DocumentProvider
{
    private $formDoc;

    public function __construct(FormDoc $formDoc)
    {
        $this->formDoc = $formDoc;
    }

    public function getDocumentsForFileAccessibleByUser(File $file, User $user)
    {
        $allFormDocs = $file->formDocs()->submitted()->orderBy('submitted_at', 'DESC')->get();

        $allFormDocs->load('teams');

        return $allFormDocs->filter(function($formDoc, $key) use ($user) {

            return $formDoc->isAccessibleBy($user);
        });
    }
}
