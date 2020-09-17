@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Index,
])

@section('content')
    <h1>
        {!! \App\icon\files(['mr-2']) !!}{{ __('admin.file-types') }}
    </h1>


    @if (count($fileTypes) > 0)
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('admin.file-types.create') }}" class="btn btn-primary">
                        {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newFileType') }}
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
                            @foreach($fileTypes as $fileType)
                                <tr>
                                    <td class="text-center" data-search="">
                                        {!! $fileType->icon() !!}
                                    </td>
                                    <td data-sort="{{ $fileType->name }}" data-search="{{ $fileType->name }}">
                                        <a href="{{ route('admin.file-types.show', [$fileType]) }}">
                                            {{ $fileType->name }}
                                        </a>
                                    </td>
                                    <td class="text-center" data-order="{{ $fileType->active ? '1' : '0' }}" data-search=""><span class="far fa{{ ($fileType->active) ? '-check' : '' }}-square"></span></td>
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
                            {!! \App\icon\files(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.fileType_description') }}</p>

                        <hr>

                        <a class="btn btn-primary" href="{{ route('admin.file-types.create') }}">{{ __('admin.fileType_createFirstFileNow') }}</a>
                    </div>
                </div>

            </div>

        </div>
    @endif
@endsection
