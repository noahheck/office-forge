@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Visualizations\Show($report, $dataset, $visualization),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h3>
                {!! \App\icon\datasets(['mr-2']) !!}{{ $dataset->name }}
            </h3>

            <div class="card document">
                <div class="card-body">

                    <h2>{!! \App\icon\visualizations(['mr-2']) !!}{{ __('report.visualizations') }}</h2>

                    <hr>

                    <div class="d-flex">

                        <h5 class="flex-grow-1">{!! \App\icon\visualizations(['mr-2']) !!} - {{ $visualization->label }}</h5>

                        <a href="{{ route("admin.reports.datasets.visualizations.edit", [$report, $dataset, $visualization]) }}" class="flex-grow-0 btn btn-primary btn-sm">
                            {!! \App\icon\edit(['mr-2']) !!}{{ __('admin.dataset_editField') }}
                        </a>
                    </div>

                    <div>
                        <p class="ml-2">{{ $visualization->label }}</p>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
