@extends("layouts.admin")

@push('meta')
    @meta('reportId', $report->id)
    @meta('datasetId', $dataset->id)
@endpush

@push('styles')
    @style('css/document.css')
@endpush

@push('scripts')
    @script('js/page.admin.reports.datasets.show.js')
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

                        <div class="list-group" id="datasetFilters">
                            @foreach ($dataset->filters as $filter)
                                <a class="list-group-item list-group-item-action d-flex" href="{{ route('admin.reports.datasets.filters.edit', [$report, $dataset, $filter]) }}" data-id="{{ $filter->id }}">
                                    <div class="flex-grow-1">
                                        {!! $dataset->datasetable->icon(['fa-fw', 'mr-2']) !!}{{ $filterDescriptor->descriptorForFilter($filter) }}
                                    </div>
                                    <div class="flex-grow-0 pl-3 sort-handle cursor-grabbing">
                                        {!! \App\icon\verticalSort([]) !!}
                                    </div>
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
                        <div class="list-group" id="datasetFields">
                            @foreach ($dataset->fields as $field)
                                <a class="list-group-item list-group-item-action d-flex" href="{{ route('admin.reports.datasets.fields.edit', [$report, $dataset, $field]) }}" data-id="{{ $field->id }}">
                                    <div class="flex-grow-1">
                                        {!! $dataset->datasetable->icon(['fa-fw', 'mr-2']) !!}{{ $field->label }}
                                    </div>
                                    <div class="flex-grow-0 pl-3 sort-handle cursor-grabbing">
                                        {!! \App\icon\verticalSort([]) !!}
                                    </div>
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

                    <hr>

                    <div class="d-flex mb-2">
                        <h5 class="flex-grow-1">
                            {!! \App\icon\visualizations(['mr-2']) !!}{{ __('report.visualizations') }}
                        </h5>
                        <a class="btn btn-primary btn-sm flex-grow-0" href="{{ route('admin.reports.datasets.visualizations.create', [$report, $dataset]) }}">
                            {!! \App\icon\circlePlus(['mr-2']) !!}{{ __('admin.dataset_newVisualization') }}
                        </a>
                    </div>






                    @if ($dataset->visualizations->count() > 0)
                        <div class="list-group" id="datasetVisualizations">
                            @foreach ($dataset->visualizations as $visualization)
                                <a class="list-group-item list-group-item-action d-flex" href="{{ route('admin.reports.datasets.visualizations.edit', [$report, $dataset, $visualization]) }}" data-id="{{ $visualization->id }}">
                                    <div class="flex-grow-0">
                                        {!! \App\icon\visualizations(['fa-fw', 'mr-2']) !!}
                                    </div>
                                    <div class="flex-grow-1">
                                        {{ $visualization->label }}
                                        <small>
                                            <br>
                                            {{ __('report.visualizationType_' . $visualization->type) }}
                                        </small>
                                    </div>
                                    <div class="flex-grow-0 pl-3 sort-handle cursor-grabbing">
                                        {!! \App\icon\verticalSort([]) !!}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-resource">
                            {!! \App\icon\visualizations(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.dataset_visualization_description') }}</p>

                        <hr>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.reports.datasets.visualizations.create', [$report, $dataset]) }}">{{ __('admin.dataset_visualization_createFirstFieldNow') }}</a>
                        </p>
                    @endif








                </div>
            </div>

        </div>

    </div>

@endsection
