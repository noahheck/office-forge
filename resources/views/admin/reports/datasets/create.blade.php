@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Create($report),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\datasets(['mr-2']) !!}{{ __('admin.newDataset') }}
            </h1>

            <p class="text-muted">{{ __('admin.newDataset_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.reports.datasets._form', [
                        'action' => route('admin.reports.datasets.store', [$report]),
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
