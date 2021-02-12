@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Edit($report),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\reports(['mr-2']) !!}{{ __('admin.editReport') }}
            </h1>

            <p class="text-muted">{{ __('admin.editReport_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.reports._form', [
                        'action' => route('admin.reports.update', [$report]),
                        'method' => 'PUT',
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
