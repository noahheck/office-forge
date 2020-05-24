@extends('layouts.app')

@push('styles')
    @style('css/home.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Home),
])


@section('content')

    <div class="row">

        <div class="col-12">

            <div class="card shadow">

                <div class="card-body">

                    <div class="row">

                        <div class="col-12 col-sm-4 col-lg-3 mb-3">

                            <h3>{!! \App\icon\files(['mr-2']) !!}{{ __('file.myFiles') }}</h3>

                            <hr>

                            @forelse ($myFiles as $file)

                                @if($loop->first)

                                    <div class="list-group myFiles">

                                @endif

                                    <a class="list-group-item list-group-item-action d-flex p-1" href="{{ route("files.show", [$file]) }}">

                                        <div class="w-50p text-center">
                                            {!! $file->icon(['file-icon']) !!}
                                        </div>
                                        <div class="flex-grow-1 pl-2 overflow-x-ellipsis">
                                            {{ $file->name }}
                                            <br>
                                            <small class="font-italic text-muted">{{ $file->fileType->name }}</small>
                                        </div>

                                    </a>

                                @if($loop->last)
                                    </div>
                                @endif
                            @empty

                                <div class="border p-3">
                                    <div class="text-center border-bottom mb-3">
                                        {!! \App\icon\files(['fs-96px', 'text-primary', 'p-3', 'mb-3']) !!}
                                    </div>
                                    <p>{{ __('file.myFilesDescription') }}</p>
                                </div>

                            @endforelse

                        </div>




                        <div class="col-12 col-sm-8 col-lg-9">

                            <h3>
                                {!! \App\icon\myWork() !!}
                                My Work
                            </h3>

                            <hr>

                            <h4 class="separator">
                                <span>
                                    {!! \App\icon\calendar() !!} Due today
                                </span>
                            </h4>

                            @forelse ($myWork as $workItem)

                                @php
                                    $activity = $workItem;
                                    $formDoc = $workItem;
                                @endphp

                                @if($loop->first)
                                    <div class="list-group activities">
                                @endif

                                        <a class="list-group-item list-group-item-action d-flex" href="{{ $workItem->workItemListHref() }}">

{{--                                            @include("_component._" . $workItem::WORK_ITEM_KEY)--}}

                                            <div class="flex-grow-0">
                                                {!! $workItem->icon() !!}
                                            </div>
                                            <div class=" pl-2 flex-grow-1 overflow-x-ellipsis">
                                                {{ $workItem->name }}
                                                @if ($workItem->due_date)
                                                    <small>
                                                        <br>
                                                        {!! \App\icon\calendar() !!}
                                                        {{ \App\format_date($workItem->due_date) }}
                                                    </small>
                                                @endif

                                            </div>

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



                </div>

            </div>

        </div>

        {{--<div class="col-12 col-md-8 col-lg-7">

            <div class="shadow card home--panel activities-panel">
                <div class="card-header d-flex">
                    <h4 class="mb-0 flex-grow-1">{!! \App\icon\myWork(['mr-1']) !!}My Work</h4>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary border-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-plus-circle"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item" href="{{ route("activities.create") }}">{{ __('activity.newActivity') }}</a>
                            @foreach ($processOptions as $__process)
                                @if ($loop->first)
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">{!! \App\icon\processes(['fa-fw']) !!} {{ __('app.processes') }}</span>
                                @endif
                                <a class="dropdown-item" href="{{ route('activities.create', ['process_id' => $__process->id]) }}">
                                    {{ $__process->name }}
                                </a>
                            @endforeach
                            @foreach ($templates as $__template)
                                @if ($loop->first)
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">{!! \App\icon\formDocs(['fa-fw']) !!} {{ __('app.formDocs') }}</span>
                                @endif
                                <a class="dropdown-item" href="{{ route('form-docs.create', ['form_doc_template_id' => $__template->id]) }}">
                                    {{ $__template->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @forelse ($myWork as $workItem)

                        @php
                        $activity = $workItem;
                        $formDoc = $workItem;
                        @endphp

                        @if($loop->first)
                            <div class="list-group activities">
                        @endif

                            <a class="list-group-item list-group-item-action" href="{{ $workItem->workItemListHref() }}">

                                @include("_component._" . $workItem::WORK_ITEM_KEY)

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

        </div>

        <div class="col-12 col-md-4 col-lg-5">

            <div class="shadow card home--panel my-files-panel">
                <div class="card-header">
                    <h4 class="mb-0 flex-grow-1">{!! \App\icon\files(['mr-1']) !!}{{ __('file.myFiles') }}</h4>
                </div>
                <div class="card-body">
                    @forelse ($myFiles as $file)

                        @if($loop->first)
                            <div class="list-group myFiles">
                                @endif

                                <a class="list-group-item list-group-item-action d-flex" href="{{ route("files.show", [$file]) }}">

                                    <div class="sssflex-grow-0 w-50p text-center">
                                        {!! $file->icon(['file-icon']) !!}
                                    </div>
                                    <div class="flex-grow-1 pl-2">
                                        {{ $file->name }}
                                        <br>
                                        <small class="font-italic text-muted">{{ $file->fileType->name }}</small>
                                    </div>

                                </a>

                                @if($loop->last)
                            </div>
                        @endif
                    @empty

                        <div class="empty-resource border p-3">
                            {!! \App\icon\files(['empty-resource-icon']) !!}
                            <p>{{ __('file.myFilesDescription') }}</p>
                        </div>

                    @endforelse
                </div>

            </div>

        </div>--}}

    </div>
@endsection
