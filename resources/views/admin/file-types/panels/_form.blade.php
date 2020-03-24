<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12">

            @errors('name')

            @textField([
                'name' => 'name',
                'label' => __('file.panel_name'),
                'value' => old('name', $panel->name),
                'placeholder' => __('file.panel_nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

{{--            <hr>--}}

            {{--@teamMultiSelectField([
                'name' => 'teams',
                'label' => __('file.form_teamAccessApproval'),
                'values' => old('teams', $form->teams),
                'teams' => $teamOptions,
                'placeholder' => __('app.selectTeams'),
                'description' => __('file.form_teamAccessApprovalDescription'),
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('teams'),
            ])--}}



        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.processes.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
