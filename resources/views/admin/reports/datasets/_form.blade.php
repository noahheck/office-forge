@push('scripts')
    @script('js/page.admin.reports.datasets._form.js')
@endpush

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
                'label' => __('report.dataset_name'),
                'value' => old('name', $dataset->name),
                'placeholder' => __('report.dataset_nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            <hr>

            @errors('datasetable_type')

            @selectField([
                'name' => 'datasetable_type',
                'label' => __('report.dataset_whatKindOfData'),
                'details' => '',
                'value' => old('datasetable_type', $dataset->datasetable_type),
                'options' => [
                    'App\FileType' => __('app.files'),
                    'App\FormDoc\Template' => __('app.formDocs'),
                ],
                'placeholder' => __('report.dataset_whatKindOfData'),
                'required' => true,
                'autofocus' => false,
                'error' => $errors->has('datasetable_type'),
                'readonly' => false,
                'fieldOnly' => false,
            ])

            <div class="datasetable_type_option_container d-none" id="App_FileType_datasetable_type_option_container">

                @errors('App_FileType_datasetable_id')

                @fileTypeSelectField([
                    'name' => 'App_FileType_datasetable_id',
                    'label' => __('app.fileType'),
                    'value' => old('App_FileType_datasetable_id', ($dataset->datasetable_type === 'App\FileType') ? $dataset->datasetable_id : ''),
                    'fileTypes' => $fileTypeOptions,
                    'placeholder' => "Select a FileType",
                    'description' => '',
                    'required' => false,
                    'autofocus' => false,
                    'error' => $errors->has('App_FileType_datasetable_id'),
                    'fieldOnly' => false,
                ])
            </div>


            <div class="datasetable_type_option_container d-none" id="App_FormDoc_Template_datasetable_type_option_container">

                @errors('App_FormDoc_Template_datasetable_id')

                @selectField([
                    'name' => 'App_FormDoc_Template_datasetable_id',
                    'label' => __('app.formDocs'),
                    'details' => '',
                    'value' => old('App_FormDoc_Template_datasetable_type', ($dataset->datasetable_type === 'App\FormDoc\Template') ? $dataset->datasetable_id : ''),
                    'options' => $formDocTemplateOptions,
                    'placeholder' => __('report.dataset_whatKindOfData'),
                    'required' => false,
                    'autofocus' => false,
                    'error' => $errors->has('App_FormDoc_Template_datasetable_id'),
                    'readonly' => false,
                    'fieldOnly' => false,
                ])
            </div>

        </div>

    </div>

    <hr>

    <div class="d-flex">

        <div class="flex-grow-1">

            <button type="submit" class="btn btn-primary">
                {{ __('app.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ url()->previous(route('admin.reports.show', [$report])) }}">
                {{ __('app.cancel') }}
            </a>

        </div>

        @if ($dataset->id)
            <div class="flex-grow-0">
                <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                    {{ __('app.moreOptions') }}
                    {!! \App\icon\chevronDown() !!}
                </button>
            </div>
        @endif

    </div>

</form>

@if($dataset->id)
    <div class="collapse text-right" id="moreOptionsContainer">

        <hr>

        <form action="{{ route("admin.reports.datasets.destroy", [$report, $dataset]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $dataset->name }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                {!! \App\icon\trash() !!}
                {{ __('admin.deleteDataset') }}
            </button>
        </form>

    </div>
@endif
