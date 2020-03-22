<?php

namespace App\Http\Controllers\File;

use App\File;
use App\FileType\Form;
use App\Http\Controllers\Controller;
use App\Jobs\File\Form\Update;
use App\Team\MemberProvider;
use Illuminate\Http\Request;
use App\Http\Requests\File\Forms\Update as UpdateRequest;
use function App\flash_success;

class FormController extends Controller
{
    public function index(Request $request, File $file)
    {
        $user     = $request->user();
        $fileType = $file->fileType;

        $fileType->load(['forms', 'forms.teams']);

        $forms = $fileType->forms->filter(function($form, $key) use($user) {
            return $form->isAccessibleBy($user);
        });

        return $this->view('files.forms.index', compact('file', 'fileType', 'forms'));
    }

    public function show(Request $request, File $file, Form $form, MemberProvider $memberProvider)
    {
        $user     = $request->user();
        abort_unless($form->isAccessibleBy($user), 403, __('app.error_noAccess', ['itemName' => __('file.form')]));

        $fileType = $file->fileType;
        $values   = $file->formFieldValues;

        return $this->view('files.forms.show', compact(
            'file',
            'fileType',
            'form',
            'values',
            'memberProvider'
        ));
    }

    public function update(UpdateRequest $request, File $file, Form $form)
    {
        $user     = $request->user();
        abort_unless($form->isAccessibleBy($user), 403, __('app.error_noAccess', ['itemName' => __('file.form')]));

        $this->dispatchNow($formUpdated = new Update($file, $form, $request->all()));

        flash_success(__('app.itemUpdated', ['itemName' => $form->name]));

        if ($return = $request->get('return')) {
            return redirect($return);
        }

        return redirect()->route('files.show', [$file]);
    }
}
