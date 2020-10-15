<?php


namespace App\FormDoc;


use App\FormDoc;

class Provider
{
    private $formDoc;

    public function __construct(FormDoc $formDoc)
    {
        $this->formDoc = $formDoc;
    }

    public function getFormDocsByFormDocIdAccessibleByUser($user, $formDocIds)
    {
        $formDocs = $this->formDoc
            ->whereIn('id', $formDocIds)
            ->orderBy('DATE', 'ASC')
            ->orderBy('TIME', 'ASC')
            ->orderBy('id', 'ASC')
            ->get();

        $formDocs->load(['creator', 'creator.headshots', 'file', 'teams', 'file.headshots']);

        $formDocs = $formDocs->filter(function($formDoc, $key) use ($user) {

            return $user->can('view', $formDoc);
        });

        return $formDocs;
    }

    public function getFormDocsAccessibleByUser(
        $user,
        $from,
        $to,
        $templateIds = [],
        $submittedBy = [],
        $includeDrafts = false
    ) {
        $query = $this->formDoc
            ->whereBetween('date', [date('Y-m-d', strtotime($from)), date('Y-m-d', strtotime($to))])
            ->orderBy('DATE', 'DESC')
            ->orderBy('TIME', 'DESC')
            ->orderBy('id', 'DESC');

        if (count($templateIds) > 0) {
            $query->whereIn('form_doc_template_id', $templateIds);
        }

        if (count($submittedBy) > 0) {
            $query->whereIn('creator_id', $submittedBy);
        }

        if (! (bool) $includeDrafts) {
            $query->whereNotNull('submitted_at');
        }

        $formDocs = $query->get();

        $formDocs->load(['creator', 'creator.headshots', 'file', 'teams', 'file.headshots']);

        $formDocs = $formDocs->filter(function($formDoc, $key) use ($user) {

            return $user->can('view', $formDoc);
        });

        return $formDocs;
    }
}
