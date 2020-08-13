@extends("layouts.app")

@push('meta')
    @meta('fileId', $file->id)
    @meta('fileTypeId', $fileType->id)
@endpush

@push('styles')
    @style('css/files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Show($fileType, $file))
])

@section('content')

<div class="file">

    <h4 class="h5 text-muted pl-3">{!! $fileType->icon() !!} - {{ $fileType->name }}</h4>

    <div class="row file">

        <div class="col-12 col-md-4 col-xl-3 mb-3">

            <div class="card shadow mb-3">
                <div class="card-body">
                    <h3>{{ $file->name }}</h3>

                    <hr>

                    <div class="text-center">
                        {!! $file->thumbnail() !!}
                    </div>

                    <hr>

                    <div class="">
                        <h5 class="">{!! \App\icon\accessLock(['mr-2']) !!}{{ __('file.accessLocks') }}</h5>
                        @foreach ($file->accessLocks as $accessLock)
                            @if($loop->first)
                                <ul class="list-group">
                            @endif
                                <li class="list-group-item">
                                    {!! \App\icon\lock(['mr-2']) !!}{{ $accessLock->name }}
                                </li>
                            @if($loop->last)
                                </ul>
                            @endif
                        @endforeach
                    </div>

                    <hr>

                    <div class="text-center">

                        @if($inMyFiles)

                            <form action="{{ route("remove-from-my-files", [$file]) }}" method="POST">
                                @csrf
                                <div class="dropdown">

                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {!! \App\icon\inMyFiles(['mr-2']) !!}{{ __('file.inMyFiles') }}
                                    </button>

                                    <div class="dropdown-menu">
                                        <button type="submit" class="dropdown-item">
                                            <span class="fas fa-times mr-2"></span>{{ __('file.removeFromMyFiles') }}
                                        </button>
                                    </div>

                                </div>
                            </form>

                        @else

                            <form action="{{ route("add-to-my-files", [$file]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-light">
                                    {!! \App\icon\notInMyFiles(['mr-2']) !!}{{ __('file.addToMyFiles') }}
                                </button>
                            </form>

                        @endif

                    </div>




                    <hr>

                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('files.edit', [$file]) }}">
                            {!! \App\icon\edit(['mr-2']) !!}{{ __('app.edit') }} {{ $fileType->name }}
                        </a>
                    </div>
                </div>
            </div>

            @if ($forms->count() > 0)
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('file.forms') }}</h4>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach ($forms as $form)
                            <a href="{{ route('files.forms.show', [$file, $form]) }}" class="list-group-item list-group-item-action">{{ $form->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>


        <div class="col-12 col-md-8 col-xl-9">

            {{-- Panels panel --}}
            @if ($panels->count() > 0)

                <div class="card shadow panels mb-3">
                    <div class="card-header">
                        <h4 class="mb-0">{!! \App\icon\fileDetails(['mr-2']) !!}{{ __('file.details') }}</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-12 col-sm-5 col-lg-4 col-xl-3 mb-3 mb-sm-0">
                                <div class="list-group panels-tabs" id="panelsTabs" role="tablist">
                                    @foreach ($panels as $panel)
                                        <a id="#panel_tab_{{ $panel->id }}" href="#panel_panel_{{ $panel->id }}" class="list-group-item list-group-item-action @if($loop->first) active @endif" data-toggle="list" role="tab" aria-controls="panel_panel_{{ $panel->id }}">{{ $panel->name }}</a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12 col-sm-7 col-lg-8 col-xl-9 border-left">

                                <div class="tab-content panels-content" id="panelsContent">
                                    @foreach ($panels as $panel)
                                        <div class="panel-fields tab-pane @if ($loop->first) show active @endif" id="panel_panel_{{ $panel->id }}" role="tabpanel" aria-labelledby="panel_tab_{{ $panel->id }}">
                                            <h4>{!! \App\icon\fileDetails(['mr-2']) !!}{{ $panel->name }}</h4>

                                            <hr>

                                            <div class="panel-content">
                                                @foreach ($panel->fields as $field)
                                                    @include('_panel_field.' . $field->field_type, [
                                                        'field' => $field,
                                                        'value' => optional($values->firstWhere('file_type_form_field_id', $field->id)),
                                                        'preview' => false,
                                                    ])
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            @endif
            {{-- End Panels panel --}}




            {{-- Activities Panel --}}
            <div class="card shadow activities-card mb-3">
                <div class="card-header d-flex">
                    <h4 class="mb-0 flex-grow-0">{!! \App\icon\activities(['mr-2']) !!}{{ __('app.activities') }}</h4>
                    <div class="d-flex flex-grow-1">
                        <div class="dropdown flex-grow-1 ml-3">
                            <button class="btn btn-sm btn-outline-secondary border-0 dropdown-toggle" type="button" id="showActivitiesDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @switch($activityView)

                                    @case('open')
                                        {{ __('activity.openActivities') }}
                                        @break

                                    @case('all')
                                        {{ __('activity.allActivities') }}
                                        @break

                                @endswitch
                            </button>
                            <div class="dropdown-menu" aria-labelledby="showActivitiesDropdownMenuButton">

                                @switch($activityView)

                                    @case('open')
                                        <a class="dropdown-item" href="{{ route('files.show', [$file, 'show_activities' => 'all']) }}">{{ __('activity.allActivities') }}</a>
                                        @break

                                    @case('all')
                                        <a class="dropdown-item" href="{{ route('files.show', [$file]) }}">{{ __('activity.openActivities') }}</a>
                                        @break

                                @endswitch

                            </div>
                        </div>
                        <div class="dropdown ml-2">
                            <button class="btn btn-sm btn-outline-secondary border-0 dropdown-toggle" type="button" id="newActivityDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {!! \App\icon\circlePlus() !!}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="newActivityDropdownMenuButton">

                                <a class="dropdown-item" href="{{ route("activities.create", ['file_id' => $file->id]) }}">{{ __('activity.newActivity') }}</a>
                                @foreach ($processesToCreate as $__process)
                                    @if ($loop->first)
                                        <span class="dropdown-header">{!! \App\icon\processes(['fa-fw']) !!} {{ __('app.processes') }}</span>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('activities.create', ['file_id' => $file->id, 'process_id' => $__process->id]) }}">
                                        {{ $__process->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    @forelse ($activities as $activity)

                        @if($loop->first)
                            <div class="list-group activities">
                        @endif

                        <a class="list-group-item list-group-item-action" href="{{ route("activities.show", [$activity]) }}">
                            @include("_component._activity", [
                                'context' => 'file',
                            ])
                        </a>

                        @if($loop->last)
                            </div>
                        @endif

                    @empty

                        <div class="empty-resource border p-3">
                            {!! \App\icon\activities(['empty-resource-icon']) !!}
                            <p>{{ __('activity.description') }}</p>
                        </div>

                    @endforelse

                </div>
            </div>
            {{-- End Activities Panel --}}












            {{-- Documents Panel --}}
            <div class="card shadow activities-card mb-3">
                <div class="card-header d-flex">
                    <h4 class="mb-0 flex-grow-0">{!! \App\icon\formDocs(['mr-2']) !!}{{ __('app.formDocs') }}</h4>
                    <div class="d-flex flex-grow-1">
                        <div class="dropdown flex-grow-1 ml-3">
                            {{--
                            // Potential place for a filter dropdown or similar
                            <button class="btn btn-sm btn-outline-secondary border-0 dropdown-toggle" type="button" id="showActivitiesDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @switch($activityView)

                                    @case('open')
                                    {{ __('activity.openActivities') }}
                                    @break

                                    @case('all')
                                    {{ __('activity.allActivities') }}
                                    @break

                                @endswitch
                            </button>
                            <div class="dropdown-menu" aria-labelledby="showActivitiesDropdownMenuButton">

                                @switch($activityView)

                                    @case('open')
                                    <a class="dropdown-item" href="{{ route('files.show', [$file, 'show_activities' => 'all']) }}">{{ __('activity.allActivities') }}</a>
                                    @break

                                    @case('all')
                                    <a class="dropdown-item" href="{{ route('files.show', [$file]) }}">{{ __('activity.openActivities') }}</a>
                                    @break

                                @endswitch

                            </div>--}}
                        </div>
                        <div class="dropdown ml-2">
                            <button class="btn btn-sm btn-outline-secondary border-0 dropdown-toggle" type="button" id="newActivityDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {!! \App\icon\circlePlus([]) !!}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="newActivityDropdownMenuButton">

                                @forelse ($formDocTemplates as $__template)
                                    @if ($loop->first)
                                        <span class="dropdown-header">{!! \App\icon\formDocs(['fa-fw']) !!} {{ __('app.formDocs') }}</span>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('form-docs.create', ['file_id' => $file->id, 'form_doc_template_id' => $__template->id]) }}">
                                        {{ $__template->name }}
                                    </a>
                                @empty
                                    <div class="p-3 text-muted">
                                        {{ __('file.formDoc_noFormDocsForThisFileType', ['fileType' => $file->fileType->name]) }}.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    @forelse ($documents as $formDoc)

                        @if($loop->first)
                            <div class="list-group formDocs">
                        @endif

                            <a class="list-group-item list-group-item-action" href="{{ route("form-docs.show", [$formDoc]) }}">
                                @include("_component._form-doc", [
                                    'context' => 'file',
                                ])
                            </a>

                        @if($loop->last)
                            </div>
                        @endif

                    @empty

                        <div class="empty-resource border p-3">
                            {!! \App\icon\formDocs(['empty-resource-icon']) !!}
                            <p>{{ __('admin.formDoc_description') }}</p>
                        </div>

                    @endforelse

                </div>
            </div>
            {{-- End Activities Panel --}}



        </div>


    </div>

</div>

@endsection
