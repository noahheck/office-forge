@extends("layouts.admin")

@push('meta')
    @meta('fileTypeId', $fileType->id)
@endpush

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
@endpush

@push('scripts')
{{--    @script('js/page.admin.file-types.forms.index.js')--}}
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\AccessLocks\Index($fileType),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! $fileType->icon(['mr-2']) !!}{{ $fileType->name }}
            </h1>

            <div class="card document">

                <div class="card-body">

                    <div class="d-flex">

                        <h2 class="flex-grow-1 mb-0">
                            {!! \App\icon\accessLock(['mr-2']) !!}{{ __('admin.accessLocks') }}
                        </h2>

                        <a href="{{ route('admin.file-types.access-locks.create', [$fileType]) }}" class="btn btn-primary">
                            {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newAccessLock') }}
                        </a>

                    </div>

                    <hr>

                    @if ($fileType->accessLocks->count() > 0)

                        <ul class="list-group" id="fileTypeAccessLocks">

                            @foreach ($fileType->accessLocks as $lock)

                                <li class="list-group-item" data-id="{{ $lock->id  }}">
                                    <div>
                                        <a href="{{ route('admin.file-types.access-locks.show', [$fileType, $lock]) }}">{!! \App\icon\lock(['mr-2']) !!}{{ $lock->name }}</a>
                                    </div>

                                </li>

                            @endforeach

                        </ul>

                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10">

                                <div class="card">
                                    <div class="card-body text-center">

                                        <div class="empty-resource">
                                            {!! \App\icon\accessLock(['empty-resource-icon']) !!}
                                        </div>

                                        <p>{{ __('admin.accessLock_description') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.file-types.access-locks.create', [$fileType]) }}">{{ __('admin.accessLock_createFirstAccessLockNow') }}</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
