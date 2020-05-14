<?php

namespace App\Http\View\Composers\Layouts;

use App\FormDoc\Template\TemplateProvider;
use Illuminate\View\View;

class AppComposer
{
    private $user;
    private $templateProvider;

    public function __construct(TemplateProvider $templateProvider)
    {
        $this->user = \Auth::user();

        $this->templateProvider = $templateProvider;
    }

    public function compose(View $view)
    {
        $view->with([
            '_user' => $this->user,
            '_formDocTemplates' => $this->templateProvider->getTemplatesCreatableByUser($this->user),
        ]);
    }
}
