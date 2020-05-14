<?php

namespace App\Http\View\Composers\Layouts;

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
        $view->with([
            '_user' => $this->user,
            '_formDocTemplates' => $this->templateProvider->getTemplatesCreatableByUser($this->user),
            '_processes' => $this->processProvider->getProcessesCreatableByUser($this->user),
        ]);
    }
}
