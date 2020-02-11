<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @errors('name', 'icon')

    @textField([
        'name' => 'name',
        'label' => __('file.name'),
        'value' => old('name', $file->name),
        'placeholder' => __('file.nameExamples'),
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('name'),
    ])

    <div class="form-group required">
        <label for="icon">{{ __('file.icon') }}</label>
        <select class="selectpicker show-tick form-control" id="icon" name="icon" title="" data-live-search="true">
            @foreach (\App\File::ICON_OPTIONS as $name => $icon)
                <option value="{{ $icon }}"{{ ($file->icon === $icon) ? " selected" : "" }} data-icon="{{ $icon }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>


    <hr>

    @checkboxSwitchField([
        'name' => 'active',
        'id' => 'file_active',
        'label' => __('file.active'),
        'details' => __('file.active_description'),
        'checked' => $file->active,
        'value' => '1',
        'required' => false,
        'error' => $errors->has('active'),
    ])


    {{--<div class="row">

        <div class="col-12 col-md-9">

            @teamMultiSelectField([
                'name' => 'teams',
                'label' => __('process.instantiatingTeams'),
                'values' => $process->instantiatingTeams,
                'multiple' => true,
                'teams' => $teamOptions,
                'placeholder' => 'Select teams',
                'description' => __('process.teamsDescription'),
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('teams'),
            ])

            @textEditorField([
                'name' => 'details',
                'id' => 'process_details',
                'label' => __('process.details'),
                'required' => false,
                'value' => $process->details,
                'placeholder' => __('process.detailsExamples'),
                'description' => __('process.detailsDescription'),
                'toolbar' => 'full',
                'resourceType' => get_class($process),
                'resourceId' => $process->id,
            ])

        </div>

    </div>--}}

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.processes.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
