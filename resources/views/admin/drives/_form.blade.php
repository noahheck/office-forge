<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @if ($fileType = $drive->fileType)

        <h4>{!! $fileType->icon(['mr-2']) !!}{{ $fileType->name }}</h4>

        <hr>

        @hiddenField([
            'name' => 'file_type_id',
            'value' => $drive->file_type_id,
        ])

    @endif

    @hiddenField([
        'name' => 'return',
        'value' => old('return', url()->previous()),
    ])

    <div class="row">

        <div class="col-12">

            @errors('name', 'active', 'teams')

            @textField([
                'name' => 'name',
                'label' => __('fileStore.drive_name'),
                'value' => old('name', $drive->name),
                'placeholder' => __('fileStore.drive_nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            @textareaField([
                'name' => 'description',
                'label' => __('fileStore.drive_description'),
                'details' => '',
                'value' => old('description', $drive->description),
                'placeholder' => __('fileStore.drive_descriptionExamples'),
                'rows' => '3',
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('description'),
                'readonly' => false,
            ])

            <hr>

            @teamMultiSelectField([
                'name' => 'teams',
                'label' => __('fileStore.drive_teamAccessApproval'),
                'values' => old('teams', $drive->teams),
                'teams' => $teamOptions,
                'placeholder' => __('app.selectTeams'),
                'description' => __('fileStore.drive_teamAccessApprovalDescription'),
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('teams'),
            ])

        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.drives.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
