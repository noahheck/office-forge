@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Index(),
])

@section('content')
    <h1>
        {!! \App\icon\processes(['mr-2']) !!}{{ __('admin.processes') }}
    </h1>


    @if (count($processes) > 0)
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('admin.processes.create') }}" class="btn btn-primary">
                        {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newProcess') }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-bordered dt-table" data-order='[[ 0, "asc" ]]'>
                        <thead>
                            <tr>
                                <th>{{ __('process.name') }}</th>
                                <th class="w-100p">{{ __('process.fileType') }}</th>
                                <th class="w-50p">{{ __('process.active') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($processes as $process)
                                <tr>
                                    <td data-sort="{{ $process->name }}">
                                        <a href="{{ route('admin.processes.show', [$process]) }}">
                                            {!! $process->name !!}
                                        </a>
                                    </td>
                                    @if ($__fileType = $process->fileType)
                                        <td data-sort="{{ $__fileType->name }}">
                                            {!! $__fileType->icon() !!}&nbsp;{{ $__fileType->name }}
                                        </td>
                                    @else
                                        <td data-sort="">

                                        </td>
                                    @endif
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
                            {!! \App\icon\processes(['empty-resource-icon']) !!}
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
