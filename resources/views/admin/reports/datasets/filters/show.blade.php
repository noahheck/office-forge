@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Filters\Show($report, $dataset, $filter),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h3>
                {!! \App\icon\datasets(['mr-2']) !!}{{ $dataset->name }}
            </h3>

            <div class="card document">
                <div class="card-body">

                    <h2>{!! \App\icon\filters(['mr-2']) !!}{{ __('report.filter') }}</h2>

                    <hr>

                    <div class="d-flex">

                        <h5 class="flex-grow-1">{!! $filter->dataset->datasetable->icon(['mr-2']) !!}{{ $filterDescriptor->descriptorForFilter($filter) }}</h5>

                        <a href="{{ route("admin.reports.datasets.filters.edit", [$report, $dataset, $filter]) }}" class="flex-grow-0 btn btn-primary btn-sm">
                            {!! \App\icon\edit(['mr-2']) !!}{{ __('admin.editFilter') }}
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
