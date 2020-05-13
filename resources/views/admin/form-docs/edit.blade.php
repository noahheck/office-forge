@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Edit($template),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\formDocs(['mr-2']) !!}{{ __('admin.editFormDoc') }}
            </h1>

            <p class="text-muted">{{ __('admin.editFormDoc_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.form-docs._form', [
                        'action' => route('admin.form-docs.update', [$template]),
                        'method' => 'PUT',
                        'showActive' => true,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
