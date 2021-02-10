@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Visualizations\Create($report, $dataset),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\visualizations(['mr-2']) !!}{{ __('admin.dataset_newVisualization') }}
            </h1>

            <p class="text-muted">{{ __('admin.dataset_newVisualization_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.reports.datasets.visualizations._form', [
                        'action' => route('admin.reports.datasets.visualizations.store', [$report, $dataset]),
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
