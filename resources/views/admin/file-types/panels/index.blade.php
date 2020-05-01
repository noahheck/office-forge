@extends("layouts.admin")

@push('meta')
    @meta('fileTypeId', $fileType->id)
@endpush

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
@endpush

@push('scripts')
    @script('js/page.admin.file-types.panels.index.js')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Panels\Index($fileType),
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
                            {!! \App\icon\fileDetails(['mr-2']) !!}{{ __('admin.panels') }}
                        </h2>

                        <a href="{{ route('admin.file-types.panels.create', [$fileType]) }}" class="btn btn-primary">
                            {!! \App\icon\circlePlus(['mr-2']) !!}{{ __('admin.newPanel') }}
                        </a>

                    </div>

                    <hr>

                    @if ($fileType->panels->count() > 0)

                        <ul class="list-group" id="fileTypePanels">

                            @foreach ($fileType->panels as $panel)

                                <li class="list-group-item d-flex" data-id="{{ $panel->id  }}">
                                    <div class="flex-grow-1">
                                        <a href="{{ route('admin.file-types.panels.show', [$fileType, $panel]) }}">{{ $panel->name }}</a>
                                        @foreach ($panel->teams as $team)
                                            {!! $team->icon() !!}
                                        @endforeach
                                    </div>
                                    <div class="sort-handle pl-3">
                                        {!! \App\icon\verticalSort() !!}
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
                                            {!! \App\icon\fileDetails(['empty-resource-icon']) !!}
                                        </div>

                                        <p>{{ __('admin.panel_description') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.file-types.panels.create', [$fileType]) }}">{{ __('admin.panel_createFirstPanelNow') }}</a>
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
