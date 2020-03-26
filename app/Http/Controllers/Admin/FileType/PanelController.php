<?php

namespace App\Http\Controllers\Admin\FileType;

use App\FileType;
use App\FileType\Form;
use App\FileType\Panel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileType\Panel\Store as StoreRequest;
use App\Http\Requests\Admin\FileType\Panel\Update as UpdateRequest;
use App\Jobs\FileType\Panel\AddField;
use App\Jobs\FileType\Panel\Create;
use App\Jobs\FileType\Panel\Update;
use App\Jobs\FileType\Panel\UpdateFieldOrder;
use App\Team;
use Illuminate\Http\Request;
use function App\flash_success;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FileType $fileType)
    {

        return $this->view('admin.file-types.panels.index', compact('fileType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FileType $fileType)
    {
        $teamOptions = Team::all();

        $panel = new Panel;
        $panel->file_type_id = $fileType->id;

        return $this->view('admin.file-types.panels.create', compact('fileType', 'panel', 'teamOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, FileType $fileType)
    {
        $this->dispatchNow($panelCreated = new Create($fileType, $request->name, $request->teams));

        flash_success(__('admin.form_created'));

        $panel = $panelCreated->getPanel();

        return redirect()->route('admin.file-types.panels.show', [$fileType, $panel]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileType\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType, Panel $panel)
    {
        $forms = $fileType->forms;
        $forms->load('fields');

        return $this->view('admin.file-types.panels.show', compact('fileType', 'panel', 'forms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileType\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function edit(FileType $fileType, Panel $panel)
    {
        $teamOptions = Team::all();

        return $this->view('admin.file-types.panels.edit', compact('fileType', 'panel', 'teamOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FileType $fileType, Panel $panel)
    {
        $this->dispatchNow($panelUpdated = new Update($panel, $request->name, $request->teams));

        flash_success(__('admin.panel_updated'));

        return redirect()->route('admin.file-types.panels.show', [$fileType, $panel]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileType\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileType $fileType, Panel $panel)
    {
        //
    }


    public function addField(Request $request, FileType $fileType, Panel $panel)
    {
        $this->dispatchNow($fieldAdded = new AddField($panel, $request->field_id));

        flash_success(__('admin.panel_fieldAdded'));

        return redirect()->route('admin.file-types.panels.show', [$fileType, $panel]);
    }

    public function updateFieldOrder(Request $request, FileType $fileType, Panel $panel)
    {
        $this->dispatchNow($fieldOrderUpdated = new UpdateFieldOrder($fileType, $panel, $request->orderedFields));

        return $this->json(true, [
            'successMessage' => __('admin.forms_orderUpdated'),
        ]);
    }
}
