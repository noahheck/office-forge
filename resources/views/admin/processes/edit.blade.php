@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user-friends"></span> {{ __('admin.editProcess') }}
    </h1>

    <p class="text-muted">{{ __('admin.editProcess_shortDescription') }}</p>

    <div class="card">
        <div class="card-body">

            @include('admin.processes._form', [
                'action' => route('admin.processes.update', [$process]),
                'method' => 'PUT',
            ])

        </div>
    </div>
@endsection
