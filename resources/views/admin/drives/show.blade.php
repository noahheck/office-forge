@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.form-docs.show.js')--}}
@endpush

@push('styles')
    @style('css/document.css')
{{--    @style('css/admin._field.css')--}}
@endpush

@push('meta')
{{--    @meta('formDocId', $template->id)--}}
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Drives\Show($drive),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <div class="card document">
                <div class="card-body">

                    <h2>
                        {!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>&nbsp;</span>

                        <a href="{{ route('admin.drives.edit', [$drive]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editDrive') }}
                        </a>

                    </div>

                    <hr>

                    <p>{!! nl2br(e($drive->description)) !!}</p>


                    <h3 class="h4">{!! \App\icon\teams(['mr-2']) !!}{{ __('fileStore.drive_teamAccessApproval') }}</h3>

                    @if ($drive->teams->count() > 0)

                        <p>{{ __('fileStore.drive_teamAccessApprovalShortDescription') }}</p>

                        <ul class="list-group mb-3">
                            @foreach ($drive->teams as $team)
                                <li class="list-group-item">{!! $team->icon() !!} {{ $team->name }}</li>
                            @endforeach
                        </ul>

                    @else

                        <p><em>{{ __('fileStore.drive_unrestrictedDescription') }}</em></p>

                    @endif




                </div>
            </div>

        </div>
    </div>
@endsection
