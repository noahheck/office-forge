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

        $templates->load('teams');

        return $templates->filter(function($template, $key) use ($user) {

            return $user->can('create', [FormDoc::class, $template]);
        });
    }
}
