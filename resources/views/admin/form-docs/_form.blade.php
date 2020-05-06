<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12">

            @if ($fileType = $formDoc->fileType)
                <h3>{!! $fileType->iconAndName() !!}</h3>

                @hiddenField([
                    'name' => 'file_type_id',
                    'value' => $fileType->id,
                ])

                <hr>
            @endif

            @errors('name', 'active')

            @textField([
                'name' => 'name',
                'label' => __('file.formDoc_name'),
                'value' => old('name', $formDoc->name),
                'placeholder' => __('formDoc.nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            <hr>

            @teamMultiSelectField([
                'name' => 'teams',
                'label' => __('formDoc.teamAccessApproval'),
                'values' => old('teams', $formDoc->teams),
                'teams' => $teamOptions,
                'placeholder' => __('app.selectTeams'),
                'description' => __('formDoc.teamAccessApprovalDescription'),
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('teams'),
            ])

            @if ($showActive ?? false)

                <hr>

                @checkboxSwitchField([
                    'name' => 'active',
                    'id' => 'formDoc_active',
                    'label' => __('formDoc.active'),
                    'details' => __('formDoc.activeDescription'),
                    'checked' => $formDoc->active,
                    'value' => '1',
                    'required' => false,
                    'error' => $errors->has('active'),
                ])

            @endif



        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.form-docs.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
