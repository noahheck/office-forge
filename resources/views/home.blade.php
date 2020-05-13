@extends('layouts.app')

@push('styles')
    @style('css/home.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Home),
])


@section('content')

    <div class="row sssjustify-content-center">

        <div class="col-12 col-md-8 col-lg-7">

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

                            <a class="list-group-item list-group-item-action" href="{{ route($workItem::WORK_ITEM_EDIT_ROUTE, [$workItem]) }}">

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

        </div>

    </div>
@endsection
