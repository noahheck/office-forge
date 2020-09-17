@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Server\UpdateHistory),
])

@section('content')

    <h1>
        {!! \App\icon\history(['mr-2']) !!}{{ __('admin.server_updateHistory') }}
    </h1>

    <p class="text-muted">{{ __('admin.server_updateHistory_shortDescription') }}</p>

    <div class="card">
        <div class="card-body">


            <div class="table-responsive">
                <table id="users" class="table table-striped table-bordered dt-table" data-order='[[ 1, "desc" ]]'>
                    <thead>
                    <tr>
                        <th class="w-50p">{{ __('admin.server_update_successful') }}</th>
                        <th>{{ __('admin.server_update_startTime') }}</th>
                        <th>{{ __('admin.server_update_endTime') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($updates as $update)
                        <tr>
                            <td class="text-center" data-order="{{ $update->successful ? '1' : '0' }}" data-search="">
                                @if ($update->successful)
                                    {!! \App\icon\checkedBox() !!}
                                @else
                                    {!! \App\icon\uncheckedBox() !!}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.server.updates.history.update', [$update]) }}">
                                    {{ \App\format_datetime($update->created_at) }}
                                </a>
                            </td>
                            <td>{{ \App\format_datetime($update->updated_at) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection
