@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.show.js')--}}
@endpush

@push('styles')
    @style('css/admin.files.css')
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Show($fileType),
])

@section('content')

    <div class="row fileType-show">

        <div class="col-12 col-md-5 col-xl-3">

            <div class="card">

                <div class="card-body">

                    <h1 class="h3">{!! $fileType->icon(['mr-2']) !!}{{ $fileType->name }}</h1>

                    <hr>

                    <a class="btn btn-block btn-primary" href="{{ route('admin.file-types.edit', [$fileType]) }}">
                        {{ __('admin.editFileType') }}
                    </a>

                </div>

            </div>



            <div class="card mt-2">

                <div class="card-body">

                    <h4>{!! \App\icon\teams(['mr-1']) !!}{{ __('file.teamAccess') }}</h4>

                    <hr>

                    @forelse ($fileType->teams as $team)

                        @if($loop->first)

                            <p>{{ __('file.teamAccessRestrictionShortDescription') }}</p>

                            <ul class="list-group">
                        @endif

                            <li class="list-group-item">
                                {!! $team->icon() !!} {{ $team->name }}
                            </li>

                        @if ($loop->last)
                            </ul>
                        @endif

                    @empty

                        <p><em>{{ __('file.teamAccessUnrestrictedShortDescription') }}</em></p>

                    @endforelse

                </div>

            </div>




            <div class="card mt-2">

                <div class="card-body">

                    <h4>
                        {!! \App\icon\accessLock(['mr-1']) !!}{{ __('file.accessLocks') }}
                        <a href="{{ route('admin.file-types.access-locks.index', [$fileType]) }}">
                            {!! \App\icon\go([]) !!}
                        </a>
                    </h4>

                    <hr>

                    @forelse ($fileType->accessLocks as $lock)

                        @if($loop->first)

                            <p>{{ __('file.accessLocksShortDescription') }}</p>

                            <ul class="list-group">
                                @endif

                                <li class="list-group-item">
                                    {!! \App\icon\lock() !!} {{ $lock->name }}
                                </li>

                                @if ($loop->last)
                            </ul>
                        @endif

                    @empty

                        <p><em>{{ __('file.accessLocksUnrestrictedShortDescription') }}</em></p>

                    @endforelse

                </div>

            </div>





        </div>

        <div class="col-12 col-md-7 col-xl-9 mt-3 mt-md-0">

            <div class="row">

                <div class="col-12 col-xl-6 mb-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex">

                                <h3 class="h4 flex-grow-1 mb-0">
                                    {!! \App\icon\forms(['mr-2']) !!}{{ __("file.forms") }}
                                    <a href="{{ route('admin.file-types.forms.index', [$fileType]) }}">
                                        {!! \App\icon\go() !!}
                                    </a>
                                </h3>

                                <a href="{{ route('admin.file-types.forms.create', [$fileType]) }}" class="btn btn-sm btn-primary">
                                    {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newForm') }}
                                </a>

                            </div>
                            <hr>

                            @if($fileType->forms->count() > 0)

                                <ul class="list-group fileType-resource-list-group">

                                    @foreach ($fileType->forms as $form)

                                        <li class="list-group-item">
                                            <a href="{{ route('admin.file-types.forms.show', [$fileType, $form]) }}">{{ $form->name }}</a>
                                            {{-- Will be outputting the team restrictions here as well --}}
                                        </li>

                                    @endforeach

                                </ul>

                            @else

                                <div class="text-center">

                                    <div class="empty-resource">
                                        {!! \App\icon\forms(['empty-resource-icon']) !!}
                                    </div>

                                    <p>{{ __('admin.form_description') }}</p>

                                    <hr>

                                    <a class="btn btn-primary" href="{{ route('admin.file-types.forms.create', [$fileType]) }}">{{ __('admin.form_createFirstFormNow') }}</a>

                                </div>

                            @endif


                        </div>

                    </div>


                </div>










                <div class="col-12 col-xl-6 mb-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex">

                                <h3 class="h4 flex-grow-1 mb-0">
                                    {!! \App\icon\fileDetails(['mr-2']) !!}{{ __("file.panels") }}
                                    <a href="{{ route('admin.file-types.panels.index', [$fileType]) }}">
                                        {!! \App\icon\go() !!}
                                    </a>
                                </h3>

                                <a href="{{ route('admin.file-types.panels.create', [$fileType]) }}" class="btn btn-sm btn-primary">
                                    {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newPanel') }}
                                </a>

                            </div>

                            <hr>

                            @if($fileType->panels->count() > 0)

                                <ul class="list-group fileType-resource-list-group">

                                    @foreach ($fileType->panels as $panel)

                                        <li class="list-group-item">
                                            <a href="{{ route('admin.file-types.panels.show', [$fileType, $panel]) }}">{{ $panel->name }}</a>
                                        </li>

                                    @endforeach

                                </ul>

                            @else

                                <div class="text-center">

                                    <div class="empty-resource">
                                        {!! \App\icon\fileDetails(['empty-resource-icon']) !!}
                                    </div>

                                    <p>{{ __('admin.panel_description') }}</p>

                                    <hr>

                                    <a class="btn btn-primary" href="{{ route('admin.file-types.panels.create', [$fileType]) }}">{{ __('admin.panel_createFirstPanelNow') }}</a>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>








                <div class="col-12 col-xl-6 mb-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex">

                                <h3 class="h4 flex-grow-1 mb-0">
                                    {!! \App\icon\processes(['mr-2']) !!}{{ __("app.processes") }}
                                </h3>

                                <a href="{{ route('admin.processes.create', ['file_type_id' => $fileType]) }}" class="btn btn-sm btn-primary">
                                    {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newProcess') }}
                                </a>

                            </div>
                            <hr>

                            @if($fileType->processes->count() > 0)

                                <ul class="list-group fileType-resource-list-group">

                                    @foreach ($fileType->processes as $process)

                                        <li class="list-group-item">
                                            <a href="{{ route('admin.processes.show', [$process]) }}">{{ $process->name }}</a>
                                            {{-- Will be outputting the team restrictions here as well --}}
                                        </li>

                                    @endforeach

                                </ul>

                            @else

                                <div class="text-center">

                                    <div class="empty-resource">
                                        {!! \App\icon\processes(['empty-resource-icon']) !!}
                                    </div>

                                    <p>{{ __('admin.process_description') }}</p>

                                    <hr>

                                    <a class="btn btn-primary" href="{{ route('admin.processes.create', ['file_type_id' => $fileType]) }}">{{ __('admin.process_createFirstProcessNow') }}</a>

                                </div>

                            @endif


                        </div>

                    </div>


                </div>








                <div class="col-12 col-xl-6 mb-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex">

                                <h3 class="h4 flex-grow-1 mb-0">
                                    {!! \App\icon\formDocs(['mr-2']) !!}{{ __("file.formDocs") }}
                                    {{--<a href="{{ route('admin.file-types.form-docs.index', [$fileType]) }}">
                                        {!! \App\icon\go() !!}
                                    </a>--}}
                                </h3>

                                <a href="{{ route('admin.form-docs.create', ['file_type_id' => $fileType]) }}" class="btn btn-sm btn-primary">
                                    {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newFormDoc') }}
                                </a>

                            </div>
                            <hr>

                            @if($fileType->formDocTemplates->count() > 0)

                                <ul class="list-group fileType-resource-list-group">

                                    @foreach ($fileType->formDocTemplates as $formDoc)

                                        <li class="list-group-item">
                                            <a href="{{ route('admin.form-docs.show', [$formDoc]) }}">{{ $formDoc->name }}</a>
                                            {{-- Will be outputting the team restrictions here as well --}}
                                        </li>

                                    @endforeach

                                </ul>

                            @else

                                <div class="text-center">

                                    <div class="empty-resource">
                                        {!! \App\icon\formDocs(['empty-resource-icon']) !!}
                                    </div>

                                    <p>{{ __('admin.formDoc_description') }}</p>

                                    <hr>

                                    <a class="btn btn-primary" href="{{ route('admin.form-docs.create', ['file_type_id' => $fileType]) }}">{{ __('admin.formDoc_createFirstFormDocNow') }}</a>

                                </div>

                            @endif


                        </div>

                    </div>


                </div>







            </div>

        </div>

    </div>
@endsection
