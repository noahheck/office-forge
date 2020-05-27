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

                            <div class="my-work">

                                <h3>{!! \App\icon\myWork(['mr-2']) !!}{{ __('app.myWork') }}</h3>

                                <hr>

                                <ul class="nav nav-tabs" id="myWork_tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="myWork_tab" data-toggle="tab" href="#myWork" role="tab" aria-controls="workingOn" aria-selected="true">
                                            {{ __('app.myWork') }}
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="activities_tab" data-toggle="tab" href="#activities" role="tab" aria-controls="workingOn" aria-selected="true">
                                            {{ __('app.myActivities') }}
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content my-work-content" id="myWork_content">
                                    <div class="tab-pane show active" id="myWork" role="tabpanel" aria-labelledby="myWork_tab">

                                        @foreach (['overDue', 'inProgress', 'dueToday', 'dueThisWeek'] as $workType)

                                            @php
                                                $hasWorkInList = false;
                                                $iconFunction = "\App\icon\\" . $workType;
                                            @endphp

                                            @foreach($myWork[$workType] as $workItem)

                                                @php
                                                    $hasWorkInList = true;
                                                    $activity = $workItem;
                                                    $formDoc  = $workItem;
                                                    $task     = $workItem;
                                                @endphp

                                                @if ($loop->first)
                                                    <div class="work-type-container">

                                                        <h4 class="separator">
                                                            <span>
                                                                {!! $iconFunction(['mr-2']) !!}{{ __('app.' . $workType) }}
                                                            </span>
                                                        </h4>
                                                        <div class="list-group activities">
                                                            @endif

                                                            <a class="list-group-item list-group-item-action p-1" href="{{ $workItem->workItemListHref() }}">
                                                                @include("_component.work-list._" . $workItem::WORK_ITEM_KEY)
                                                            </a>

                                                            @if($loop->last)

                                                        </div>
                                                    </div>
                                                @endif

                                            @endforeach

                                        @endforeach

                                        @unless($hasWorkInList)
                                            <div class="d-flex justify-content-center">

                                                <div class="col-12 col-md-6 col-lg-6 col-xl-5">

                                                    <div class="card mt-3">
                                                        <div class="card-body text-center">

                                                            <div class="empty-resource">
                                                                {!! \App\icon\myWork(['empty-resource-icon']) !!}
                                                            </div>

                                                            <p>{{ __('app.myWorkDescription') }}</p>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        @endunless

                                    </div>
                                    <div class="tab-pane" id="activities" role="tabpanel" aria-labelledby="activities_tab">

                                        @forelse($activities as $activity)

                                            @if ($loop->first)
                                                <h4 class="separator">
                                                    <span>
                                                        {!! \App\icon\activities(['mr-2']) !!}{{ __('app.myActivities') }}
                                                    </span>
                                                </h4>
                                                <div class="list-group">
                                            @endif

                                                <a class="list-group-item list-group-item-action p-1" href="{{ route("activities.show", [$activity]) }}">
                                                    @include("_component.work-list._activity")
                                                </a>

                                            @if ($loop->last)
                                                </div>
                                            @endif

                                        @empty

                                            <div class="d-flex justify-content-center">

                                                <div class="col-12 col-md-6 col-lg-6 col-xl-5">

                                                    <div class="card mt-3">
                                                        <div class="card-body text-center">

                                                            <div class="empty-resource">
                                                                {!! \App\icon\activities(['empty-resource-icon']) !!}
                                                            </div>

                                                            <p>{{ __('app.myActivitiesDescription') }}</p>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        @endforelse

                                    </div>
                                </div>


                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
