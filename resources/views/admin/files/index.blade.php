@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->setCurrentLocation(__('admin.files')),
])

@section('content')
    <h1>
        <span class="fas fa-folder-open"></span> {{ __('admin.files') }}
    </h1>


    @if (count($files) > 0)
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('admin.files.create') }}" class="btn btn-primary">
                        <span class="fas fa-user-plus"></span> {{ __('admin.newFile') }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-bordered dt-table" data-order='[[ 1, "asc" ]]' data-columns='[{"orderable": false}, null, null]'>
                        <thead>
                            <tr>
                                <th class="w-50p">&nbsp;</th>
                                <th>{{ __('file.name') }}</th>
                                <th class="w-50p">{{ __('file.active') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td class="text-center">
                                        {!! $file->icon() !!}
                                    </td>
                                    <td data-sort="{{ $file->name }}">
                                        <a href="{{ route('admin.files.show', [$file]) }}">
                                            {{ $file->name }}
                                        </a>
                                    </td>
                                    <td class="text-center" data-order="{{ $file->active ? '1' : '0' }}"><span class="far fa{{ ($file->active) ? '-check' : '' }}-square"></span></td>
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
                            <span class="fas fa-folder-open empty-resource-icon"></span>
                        </div>

                        <p>{{ __('admin.file_description') }}</p>

                        <hr>

                        <a class="btn btn-primary" href="{{ route('admin.files.create') }}">{{ __('admin.file_createFirstFileNow') }}</a>
                    </div>
                </div>

            </div>

        </div>
    @endif
@endsection
