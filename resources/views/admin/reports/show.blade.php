@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.reports.show.js')
@endpush

@push('styles')
    @style('css/document.css')
@endpush

@push('meta')
    @meta('reportId', $report->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Show($report),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <div class="card document">
                <div class="card-body">

                    <h2>
                        {!! \App\icon\reports(['mr-2']) !!}{{ $report->name }}
                    </h2>

                    @if ($fileType = $report->fileType)
                        <h5 class="pl-4">{!! $fileType->icon(['mr-2']) !!}<a href="{{ route('admin.file-types.show', [$fileType]) }}">{{ $fileType->name }}</a></h5>
                    @endif

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            @if ($report->active)
                                {!! \App\icon\checkedBox(['mr-1']) !!}{{ __('report.active') }}
                            @else
                                {!! \App\icon\uncheckedBox(['mr-1']) !!}{{ __('report.active') }}
                            @endif
                        </span>

                        <a href="{{ route('admin.reports.edit', [$report]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editReport') }}
                        </a>

                    </div>

                    <hr>

                    <h3 class="h4">{!! \App\icon\filters(['mr-2']) !!}{{ __('report.filters') }}</h3>

                    @if ($report->filter_user || $report->filter_date)

                        <p>{{ __('report.report_filter_hasFilters') }}</p>
                        <p class="pl-2">
                            @if ($report->filter_user)
                                {!! \App\icon\users(['fa-fw', 'mr-2']) !!}{{ __('report.report_filter_user') }}<br>
                            @endif
                            @if ($report->filter_date === \App\Report::REPORT_FILTER_DATE_DATE)
                                {!! \App\icon\calendarDay(['fa-fw', 'mr-2']) !!}{{ __('report.report_filter_date_date') }}<br>
                            @endif
                            @if ($report->filter_date === \App\Report::REPORT_FILTER_DATE_RANGE)
                                {!! \App\icon\calendarWeek(['fa-fw', 'mr-2']) !!}{{ __('report.report_filter_date_date_range') }}<br>
                            @endif
                        </p>
                    @else
                        <p><em>{{ __('report.report_filter_noFilters') }}</em></p>
                    @endif

                    <hr>


                    <h3 class="h4">{!! \App\icon\teams(['mr-2']) !!}{{ __('report.teamAccessApproval') }}</h3>

                    @if ($report->teams->count() > 0)

                        <p>{{ __('report.teamAccessApprovalShortDescription') }}</p>
                        <ul class="list-group mb-3">
                            @foreach ($report->teams as $team)
                                <li class="list-group-item">{!! $team->icon() !!} {{ $team->name }}</li>
                            @endforeach
                        </ul>

                    @else

                        <p><em>{{ __('report.unrestrictedDescription') }}</em></p>

                    @endif

                    <hr>

                    @if($report->description)

                        @textEditorContent([
                            'content' => $report->description,
                            'classes' => [],
                        ])

                        <hr>

                    @endif

                    <h3 class="h4">{!! \App\icon\datasets(['mr-2']) !!}{{ __('report.datasets') }}</h3>

                    @if ($report->datasets()->count() > 0)
                        <div class="list-group" id="reportDatasets">
                            @foreach ($report->datasets as $dataset)
                                <a class="list-group-item list-group-item-action d-flex" href="{{ route('admin.reports.datasets.show', [$report, $dataset]) }}" data-id="{{ $dataset->id }}">
                                    <div class="flex-grow-1">
                                        {{ $dataset->name }}
                                    </div>
                                    <div class="flex-grow-0 pl-3 sort-handle cursor-grabbing">
                                        {!! \App\icon\verticalSort([]) !!}
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <hr>

                        <div class="text-right">
                            <a href="{{ route("admin.reports.datasets.create", [$report]) }}" class="btn btn-primary btn-sm">
                                {!! \App\Icon\circlePlus(['mr-2']) !!}{{ __('admin.newDataset') }}
                            </a>
                        </div>
                    @else
                        <div class="empty-resource">
                            {!! \App\icon\datasets(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.dataset_description') }}</p>

                        <hr>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.reports.datasets.create', [$report]) }}">{{ __('admin.dataset_createFirstDatasetNow') }}</a>
                        </p>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
