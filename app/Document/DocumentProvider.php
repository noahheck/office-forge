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


    public function getOpenDocumentsForUser(User $user)
    {
        return $user->createdFormDocs()->whereNull('submitted_at')->orderBy('created_at')->get();
    }

    public function getCompletedDocumentsForUser(User $user, $since = '')
    {
        return $user
            ->createdFormDocs()
            ->whereNotNull('submitted_at')
            ->submittedSince($since)
            ->orderBy('DATE', 'DESC')
        ->get();
    }


    public function getDocumentsForFileAccessibleByUser(File $file, User $user)
    {
        $allFormDocs = $file->formDocs()->submitted()->orderBy('DATE', 'DESC')->get();

        $allFormDocs->load('teams');

        return $allFormDocs->filter(function($formDoc, $key) use ($user) {

            return $user->can('view', $formDoc);
        });
    }
}
