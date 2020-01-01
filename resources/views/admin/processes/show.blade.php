@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-clipboard-list"></span>
        {{ $process->name }}
    </h1>

    <div class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-12 col-md-3 order-1 order-md-2">

                    <span class="far fa-{{ $process->active ?? false ? 'check-' : '' }}square"></span> {{ __('process.active') }}

                    <hr>

                    <a href="{{ route('admin.processes.edit', [$process]) }}" class="btn btn-primary">
                        <span class="fas fa-edit"></span> {{ __('admin.editProcess') }}
                    </a>
                </div>

                <div class="col-12 col-md-9 order-2 order-md-1">

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($process->details) !!}
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
