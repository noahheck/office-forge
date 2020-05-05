@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Create(),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\formDocs(['mr-2']) !!}{{ __('admin.newFormDoc') }}
            </h1>

            <p class="text-muted">{{ __('admin.newFormDoc_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.form-docs._form', [
                        'action' => route('admin.form-docs.store'),
                        'showActive' => false,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
