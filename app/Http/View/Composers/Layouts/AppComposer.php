<?php

namespace App\Http\View\Composers\Layouts;

use App\File;
use App\FormDoc\Template\TemplateProvider;
use App\Process\ProcessProvider;
use Illuminate\View\View;

class AppComposer
{
    private $user;
    private $templateProvider;
    private $processProvider;

    public function __construct(
        TemplateProvider $templateProvider,
        ProcessProvider $processProvider
    ) {
        $this->user = \Auth::user();

        $this->templateProvider = $templateProvider;
        $this->processProvider = $processProvider;
    }

    public function compose(View $view)
    {
        $_user = $this->user;

        $__fileTypes = \App\FileType::active()->orderBy('name')->get();

        $__fileTypes->load('teams');

        $__fileTypesToCreate = $__fileTypes->filter(function($fileType) use ($_user) {

            return $_user->can('create', [File::class, $fileType]);
        });


        $view->with([
            '_user' => $this->user,
            '_formDocTemplates' => $this->templateProvider->getTemplatesCreatableByUser($this->user),
            '_processes' => $this->processProvider->getProcessesCreatableByUser($this->user),
            '__fileTypes' => $__fileTypes,
            '__fileTypesToCreate' => $__fileTypesToCreate,
        ]);
    }
}
