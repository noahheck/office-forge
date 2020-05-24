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

                            @foreach (['overDue', 'inProgress', 'dueToday'] as $workType)

                                @php
                                $iconFunction = "\App\icon\\" . $workType;
                                @endphp

                                @forelse($myWork[$workType] as $workItem)

                                    @php
                                    $activity = $workItem;
                                    $formDoc = $workItem;
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

                                @empty
{{--                                    <em class="text-muted">No In-progress work</em>--}}
                                @endforelse

                            @endforeach

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
