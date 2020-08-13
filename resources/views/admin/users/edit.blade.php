@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Users\Edit($user),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\userEdit(['mr-2']) !!}{{ __('admin.editUser') }}
            </h1>

            <p class="text-muted">{{ __('admin.editUser_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.users._form', [
                        'action' => route('admin.users.update', [$user]),
                        'method' => 'PUT',
                        'passwordRequired' => false,
                        'passwordWarn' => true,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
