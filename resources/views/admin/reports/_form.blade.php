<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif


    <div class="row">

        <div class="col-12">

            @if ($canSelectFileType ?? false)

                @fileTypeSelectField([
                    'name' => 'file_type_id',
                    'label' => __('app.fileType'),
                    'value' => $template->file_type_id,
                    'fileTypes' => $fileTypeSelectOptions,
                    'placeholder' => '',
                    'description' => '',
                    'required' => false,
                    'autofocus' => true,
                    'error' => $errors->has('file_type_id'),
                ])

            @elseif ($fileType = $report->fileType)
                <h5>{!! $fileType->iconAndName() !!}</h5>

                @hiddenField([
                    'name' => 'file_type_id',
                    'value' => $fileType->id,
                ])

                <hr>
            @endif

            @errors('name', 'active', 'teams')

            @textField([
                'name' => 'name',
                'label' => __('report.name'),
                'value' => old('name', $report->name),
                'placeholder' => __('report.nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            @textEditorField([
                'name' => 'description',
                'id' => 'report_description',
                'label' => __('report.description'),
                'required' => false,
                'value' => $report->description,
                'placeholder' => __('report.descriptionExample'),
                'description' => __('report.descriptionDescription'),
                'toolbar' => 'full',
                'resourceType' => get_class($report),
                'resourceId' => $report->id,
            ])

            <hr>

            <h4>{!! \App\icon\filters(['mr-2']) !!}{{ __('report.filters') }}</h4>

            <p>{{ __('report.report_filters_description') }}</p>

            @errors('filter_user')

            @checkboxSwitchField([
                'name' => 'filter_user',
                'id' => 'filter_user',
                'label' => __('report.report_filter_user'),
                'details' => __('report.report_filter_userDescription'),
                'checked' => old('filter_user', $report->filter_user),
                'value' => '1',
                'required' => false,
                'error' => $errors->has('filter_user'),
            ])

            @radioGroupField([
                'name' => 'filter_date',
                'label' => __('report.report_filter_date_label'),
                'value' => old('report_date', $report->filter_date),
                'options' => \App\Report::dateFilterOptions(),
                'description' => '',
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('filter_date'),
            ])

            <hr>

            @checkboxSwitchField([
                'name' => 'active',
                'id' => 'report_active',
                'label' => __('report.active'),
                'details' => __('report.activeDescription'),
                'checked' => old('active', $report->active),
                'value' => '1',
                'required' => false,
                'error' => $errors->has('active'),
            ])

            <hr>

            @teamMultiSelectField([
                'name' => 'teams',
                'label' => __('report.teamAccessApproval'),
                'values' => old('teams', $report->teams),
                'teams' => $teamOptions,
                'placeholder' => __('app.selectTeams'),
                'description' => __('report.teamAccessApprovalDescription'),
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('teams'),
                'fieldOnly' => false,
            ])

        </div>

    </div>

    <hr>

    <div class="d-flex">

        <div class="flex-grow-1">

            <button type="submit" class="btn btn-primary">
                {{ __('app.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ url()->previous(route('admin.form-docs.index')) }}">
                {{ __('app.cancel') }}
            </a>

        </div>

        @if ($report->id)
            <div class="flex-grow-0">
                <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                    {{ __('app.moreOptions') }}
                    {!! \App\icon\chevronDown() !!}
                </button>
            </div>
        @endif

    </div>

</form>

@if($report->id)
    <div class="collapse text-right" id="moreOptionsContainer">

        <hr>

        <form action="{{ route("admin.reports.destroy", [$report]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $report->name }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                {!! \App\icon\trash() !!}
                {{ __('admin.deleteReport') }}
            </button>
        </form>

    </div>
@endif
