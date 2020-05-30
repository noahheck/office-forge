@extends('layouts.app')

@push('styles')
    @style('css/document.css')
    @style('css/user-activity.css')
@endpush

@push('scripts')
    @script('js/page.user-activity.js')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activity),
])


@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">
            <div class="card shadow document">
                <div class="card-body my-work-content">

                    <h2>{!! \App\icon\userActivity(['mr-2']) !!}{{ __('app.userActivity') }}</h2>

                    <hr>

                    <form action="{{ route("user-activity") }}" method="GET" class="bold-labels">

                        @selectField([
                            'name' => 'work_status',
                            'label' => 'Show me',
                            'details' => '',
                            'value' => $workStatus,
                            'options' => [
                                'open' => 'Open Work Items',
                                'completed' => 'Completed Work Items',
                            ],
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => true,
                            'error' => $errors->has('work_status'),
                            'readonly' => false,
                        ])

                        @admin
                            @userSelectField([
                                'name' => 'user',
                                'label' => 'For',
                                'value' => $userId,
                                'users' => $userSelectOptions,
                                'placeholder' => 'Select User',
                                'description' => '',
                                'required' => true,
                                'autofocus' => false,
                                'error' => $errors->has('user'),
                                'readonly' => false,
                            ])
                        @endadmin

                        <div id="completedWorkTimeFrameContainer" class="collapse {{ ($workStatus === 'completed') ? 'show' : '' }}">

                            @selectField([
                                'name' => 'timeFrame',
                                'label' => 'From',
                                'details' => '',
                                'value' => $timeFrame,
                                'options' => [
                                    'week' => 'The Last Week',
                                    'month' => 'The Last Month',
                                    'year' => 'The Last Year',
                                    'all_time' => 'All Time',
                                ],
                                'placeholder' => '',
                                'required' => true,
                                'autofocus' => true,
                                'error' => $errors->has('work_status'),
                                'readonly' => false,
                            ])

                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            {{ __('app.submit') }}
                        </button>

                    </form>

                    <hr>

                    @foreach (array_keys($workItems) as $workType)

                        @php
                            $iconFunction = "\App\icon\\" . $workType;
                        @endphp

                        @foreach($workItems[$workType] as $workItem)

                            @php
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



                    {{--<dl class="row">
                        @if ($file)
                            <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ $file->fileType->name }}:</dt>
                            <dd class="col-12 col-sm-9 col-xl-10">{!! $file->icon(['fa-fw', 'mhw-35p', 'mr-2', 'fs-24px']) !!}
                                @can('view', $file)
                                    <a href="{{ route("files.show", [$file]) }}">{{ $file->name }}</a>
                                @else
                                    {{ $file->name }}
                                @endcan
                            </dd>
                        @endif

                        @if ($activity)
                            <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.activity') }}:</dt>
                            <dd class="col-12 col-sm-9 col-xl-10">
                                @if ($activity->process_id)
                                    {!! \App\icon\processes(['fa-fw', 'mr-2', 'fs-24px']) !!}
                                @else
                                    {!! \App\icon\activities(['fa-fw', 'mr-2', 'fs-24px']) !!}
                                @endif
                                @can('view', $activity)
                                    <a href="{{ route("activities.show", [$activity]) }}">{{ $activity->getFullName() }}</a>
                                @else
                                    {{ $activity->getFullName() }}
                                @endcan
                            </dd>
                        @endif

                        <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('formDoc.creator') }}:</dt>
                        <dd class="col-12 col-sm-9 col-xl-10">{!! $formDoc->creator->icon(['mhw-35p', 'mr-2']) !!}{{ $formDoc->creator->name }}</dd>

                        @if ($formDoc->isSubmitted())
                            <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('formDoc.submitted') }}:</dt>
                            <dd class="col-12 col-sm-9 col-xl-10">{{ \App\format_datetime($formDoc->submitted_at) }}</dd>
                        @else
                            <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">&nbsp;</dt>
                            <dd class="col-12 col-sm-9 col-xl-10">
                                <hr>
                                <a href="{{ route('form-docs.edit', [$formDoc]) }}" class="btn btn-primary btn-sm">
                                    {!! \App\icon\edit(['mr-2']) !!}{{ __('app.edit') }}
                                </a>
                            </dd>
                        @endif
                    </dl>

                    <hr>

                    <div class="formDoc--fields">
                        @foreach ($formDoc->fields as $field)

                            @if ($field->separator)
                                <hr class="separator">
                            @endif

                            @include('_panel_field.' . $field->field_type, [
                                'field' => $field,
                                'value' => $field,
                                'preview' => false,
                            ])
                        @endforeach
                    </div>--}}

                </div>

            </div>
        </div>

    </div>
@endsection
