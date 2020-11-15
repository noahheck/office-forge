@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Show($report, $dataset),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h3>
                {!! \App\icon\reports(['mr-2']) !!}{{ $report->name }}
            </h3>

            <div class="card document">
                <div class="card-body">

                    <h2>{!! \App\icon\datasets(['mr-2']) !!}{{ $dataset->name }}</h2>

                    <hr>

                    <div class="text-right">
                        <a href="{{ route("admin.reports.datasets.edit", [$report, $dataset]) }}" class="btn btn-primary btn-sm">
                            {!! \App\icon\edit(['mr-2']) !!}{{ __('admin.editDataset') }}
                        </a>
                    </div>

                    <hr>

                    <h5>{!! \App\icon\datasets(['mr-2']) !!}{{ __('report.dataset_dataType') }}</h5>

                    <p>
                        {!! $dataset->datasetable->icon(['ml-3', 'mr-2']) !!}{{ Str::plural($dataset->datasetable->name) }}
                    </p>

                    <hr>

                    <div class="d-flex mb-2">
                        <h5 class="flex-grow-1">
                            {!! \App\icon\filters(['mr-2']) !!}{{ __('report.filters') }}
                        </h5>
                        <a class="btn btn-primary btn-sm flex-grow-0" href="{{ route('admin.reports.datasets.filters.create', [$report, $dataset]) }}">
                            {!! \App\icon\circlePlus(['mr-2']) !!}{{ __('admin.newFilter') }}
                        </a>
                    </div>

                    @if ($dataset->filters()->count() > 0)

                        <div class="list-group">
                            @foreach ($dataset->filters as $filter)
                                <a class="list-group-item list-group-item-action" href="{{ route('admin.reports.datasets.filters.edit', [$report, $dataset, $filter]) }}">
                                    {!! $dataset->datasetable->icon(['fa-fw', 'mr-2']) !!}{{ $filter->descriptor() }}
                                </a>
                            @endforeach
                        </div>

                    @else

                        <p>{{ __('admin.filter_description') }}</p>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.reports.datasets.filters.create', [$report, $dataset]) }}">{{ __('admin.filter_createFirstFilterNow') }}</a>
                        </p>
                    @endif

                    <hr>

                    <div class="d-flex mb-2">
                        <h5 class="flex-grow-1">
                            {!! \App\icon\datasetFields(['mr-2']) !!}{{ __('report.fields') }}
                        </h5>
                        <a class="btn btn-primary btn-sm flex-grow-0" href="{{ route('admin.reports.datasets.fields.create', [$report, $dataset]) }}">
                            {!! \App\icon\circlePlus(['mr-2']) !!}{{ __('admin.dataset_newField') }}
                        </a>
                    </div>

                    @if ($dataset->fields->count() > 0)
                        <div class="list-group">
                            @foreach ($dataset->fields as $field)
                                <a class="list-group-item list-group-item-action" href="{{ route('admin.reports.datasets.fields.show', [$report, $dataset, $field]) }}">
                                    {!! $dataset->datasetable->icon(['fa-fw', 'mr-2']) !!}{{ $field->label }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-resource">
                            {!! \App\icon\datasetFields(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.dataset_field_description') }}</p>

                        <hr>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.reports.datasets.fields.create', [$report, $dataset]) }}">{{ __('admin.dataset_field_createFirstFieldNow') }}</a>
                        </p>
                    @endif


                </div>
            </div>

        </div>

    </div>

@endsection
