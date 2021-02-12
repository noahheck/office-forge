@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Filters\Edit($report, $dataset, $filter),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\filters(['mr-2']) !!}{{ __('admin.editFilter') }}
            </h1>

            <p class="text-muted">{{ __('admin.editFilter_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.reports.datasets.filters._form', [
                        'action' => route('admin.reports.datasets.filters.update', [$report, $dataset, $filter]),
                        'method' => 'PUT',
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
