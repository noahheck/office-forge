<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @errors('name', 'icon')

    @textField([
        'name' => 'name',
        'label' => __('file.name'),
        'value' => old('name', $fileType->name),
        'placeholder' => __('file.nameExamples'),
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('name'),
    ])

    <div class="form-group required">
        <label for="icon">{{ __('file.icon') }}</label>
        <select class="selectpicker show-tick form-control" id="icon" name="icon" title="" data-live-search="true">
            @foreach (\App\FileType::ICON_OPTIONS as $name => $icon)
                <option value="{{ $icon }}"{{ ($fileType->icon === $icon) ? " selected" : "" }} data-icon="{{ $icon }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>


    <hr>

    @checkboxSwitchField([
        'name' => 'active',
        'id' => 'file_active',
        'label' => __('file.active'),
        'details' => __('file.active_description'),
        'checked' => $fileType->active,
        'value' => '1',
        'required' => false,
        'error' => $errors->has('active'),
    ])

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.processes.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
