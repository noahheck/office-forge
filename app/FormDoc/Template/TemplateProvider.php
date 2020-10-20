<?php


namespace App\FormDoc\Template;


use App\FormDoc;
use App\FormDoc\Template;
use App\User;

class TemplateProvider
{
    private $template;

    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    public function getTemplatesCreatableByUser(User $user, $fileTypeId = null)
    {
        $templates = $this->template->active()->where('file_type_id', $fileTypeId)->orderBy('name')->get();

        $templates->load('teams', 'creatingTeams');

        return $templates->filter(function($template, $key) use ($user) {

            return $user->can('create', [FormDoc::class, $template]);
        });
    }

    public function getTemplatesReviewableByUser(User $user)
    {
        $templates = $this->template->active()->orderBy('name')->get();

        $templates->load('teams', 'reviewingTeams', 'fileType');

        $templates = $templates->filter(function($template, $key) use ($user) {

            return $user->can('review', [FormDoc::class, $template]);
        })->sort(function($template1, $template2) {
            if (!$template1->file_type_id) {

                return ($template2->file_type_id) ? 0 : -1;
            }

            if (!$template2->file_type_id) {

                return 1;
            }

            return strnatcasecmp($template1->fileType->name, $template2->fileType->name);
        });

        return $templates;
    }
}
