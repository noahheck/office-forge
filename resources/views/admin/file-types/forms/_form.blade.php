<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12">

            @errors('name', 'active', 'details')

            @textField([
                'name' => 'name',
                'label' => __('file.form_name'),
                'value' => old('name', $form->name),
                'placeholder' => __('file.form_nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            {{--@if ($showActive ?? false)

                <hr>

                @checkboxSwitchField([
                    'name' => 'active',
                    'id' => 'task_active',
                    'label' => __('process.task_active'),
                    'checked' => $task->active,
                    'value' => '1',
                    'required' => false,
                    'error' => $errors->has('active'),
                ])

                <hr>

            @endif--}}

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
