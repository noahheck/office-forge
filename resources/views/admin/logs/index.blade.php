@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Logs\Index,
])

@section('content')
    <h1>
        {!! \App\icon\logs(['mr-2']) !!}{{ __('admin.logs') }}
    </h1>

    <div class="card">
        <div class="card-body">

            <div class="flex-grow-1">
                <p>{{ __('admin.logs_description') }}</p>
            </div>

            <hr>

            <div class="table-responsive">
                <table id="backups" class="table table-striped table-bordered dt-table" data-order='[[ 0, "desc" ]]'>
                    <thead>
                        <tr>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logFiles as $logFile)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.logs.show', [$logFile]) }}">
                                        {{ $logFile }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
