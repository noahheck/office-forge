@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.file-types.forms.show.js')--}}
@endpush

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
{{--    @style('css/admin._field.css')--}}
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
    @meta('accessLockId', $accessLock->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\AccessLocks\Show($fileType, $accessLock),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <div class="card document">
                <div class="card-body">

                    <h2>
                        {!! \App\icon\lock(['mr-2']) !!}{{ $accessLock->name }}
                    </h2>

                    <hr>

                    <div class="text-right">

                        <a href="{{ route('admin.file-types.access-locks.edit', [$fileType, $accessLock]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editAccessLock') }}
                        </a>

                    </div>

                    <hr>

                    {!! nl2br(e($accessLock->details)) !!}


                </div>
            </div>

        </div>
    </div>
@endsection
