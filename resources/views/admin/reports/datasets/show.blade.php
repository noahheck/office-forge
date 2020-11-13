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

            <h2>
                {!! \App\icon\reports(['mr-2']) !!}{{ $report->name }}
            </h2>

            <div class="card document">
                <div class="card-body">

                    <h3>{!! \App\icon\datasets(['mr-2']) !!}{{ $dataset->name }}</h3>

                    <hr>

                    <div class="text-right">
                        <a href="{{ route("admin.reports.datasets.edit", [$report, $dataset]) }}" class="btn btn-primary btn-sm">
                            {!! \App\icon\edit(['mr-2']) !!}{{ __('admin.editDataset') }}
                        </a>
                    </div>

                    <hr>

                    {!! $dataset->datasetable->icon(['mr-2']) !!}{{ Str::plural($dataset->datasetable->name) }}


                </div>
            </div>

        </div>

    </div>

@endsection
