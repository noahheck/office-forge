@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Fields\Show($report, $dataset, $field),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h3>
                {!! \App\icon\datasets(['mr-2']) !!}{{ $dataset->name }}
            </h3>

            <div class="card document">
                <div class="card-body">

                    <h2>{!! \App\icon\datasetFields(['mr-2']) !!}{{ __('report.fields') }}</h2>

                    <hr>

                    <div class="d-flex">

                        <h5 class="flex-grow-1">{!! $field->dataset->datasetable->icon(['mr-2']) !!} - {{ $field->label }}</h5>

                        <a href="{{ route("admin.reports.datasets.fields.edit", [$report, $dataset, $field]) }}" class="flex-grow-0 btn btn-primary btn-sm">
                            {!! \App\icon\edit(['mr-2']) !!}{{ __('admin.dataset_editField') }}
                        </a>
                    </div>

                    <div>
                        <p class="ml-2">{{ $field->templateField->label }}</p>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
