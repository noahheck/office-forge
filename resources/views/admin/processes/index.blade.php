@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\SystemSettings)
                    ->setCurrentLocation(__('admin.processes')),
])

@section('content')
    <h1>
        <span class="fas fa-clipboard-list"></span> {{ __('admin.processes') }}
    </h1>


    @if (count($processes) > 0)
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('admin.processes.create') }}" class="btn btn-primary">
                        <span class="fas fa-user-plus"></span> {{ __('admin.newProcess') }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-bordered dt-table" data-order='[[ 1, "asc" ]]' data-columns='[{"orderable": false}, null, null]'>
                        <thead>
                            <tr>
                                <th class="w-50p">&nbsp;</th>
                                <th>{{ __('process.name') }}</th>
                                <th class="w-50p">{{ __('process.active') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($processes as $process)
                                <tr>
                                    <td>

                                    </td>
                                    <td data-sort="{{ $process->name }}">
                                        <a href="{{ route('admin.processes.show', [$process]) }}">
                                            {!! $process->name !!}
                                        </a>
                                    </td>
                                    <td class="text-center" data-order="{{ $process->active ? '1' : '0' }}"><span class="far fa{{ ($process->active) ? '-check' : '' }}-square"></span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">

            <div class="col-12 col-md-6 col-lg-6 col-xl-5">

                <div class="card">
                    <div class="card-body text-center">

                        <div class="empty-resource">
                            <span class="fas fa-clipboard-list empty-resource-icon"></span>
                        </div>

                        <p>{{ __('admin.process_description') }}</p>
                        <p>{{ __('admin.process_createAsManyAsWanted') }}</p>

                        <hr>

                        <a class="btn btn-primary" href="{{ route('admin.processes.create') }}">{{ __('admin.process_createFirstProcessNow') }}</a>
                    </div>
                </div>

            </div>

        </div>
    @endif
@endsection
