@extends("layouts.app")

@if ($compiledReport)

@section('title')
    {{ $compiledReport->title }}
@endsection

@endif

@push('styles')
    @style('css/document.css')
    @style('css/reports.css')
@endpush

@push('scripts')
    @script('js/page._reports.js')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Reports\Index),
])

@section('content')

    <div class="row index">

        <div class="col-12 col-md-4 col-xl-3 mb-3 no-print">

            <div class="card shadow mb-3 report-select-options">

                <div class="card-body">
                    <h4>{!! \App\icon\reports(['mr-2']) !!}{{ __('app.reports') }}</h4>

                    <hr>

                    <form action="{{ route("reports.index") }}" method="GET" class="bold-labels">

                        <div class="form-group">
                            @label([
                                'for' => 'report_id',
                                'label' => 'Select a Report:',
                            ])
                            <select name="report_id" id="report_id" class="custom-select">
                                <option value="">--</option>
                                @foreach ($reports as $reportOption)
                                    <option value="{{ $reportOption->id }}" {{ $reportOption->id == $report_id ? 'selected' : '' }} data-filter-user="{{ $reportOption->filter_user }}" data-filter-date="{{ $reportOption->filter_date }}">
                                        {{ $reportOption->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="userSelect" class="d-none">
                            @userSelectField([
                                'name' => 'user_id',
                                'label' => __('app.user'),
                                'value' => $user_id ?? '',
                                'users' => $userOptions,
                                'placeholder' => '',
                                'description' => '',
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('user_id'),
                                'readonly' => false,
                                'fieldOnly' => false,
                            ])
                        </div>

                        <div id="dateSelect1" class="d-none">
                            @dateField([
                                'name' => 'date',
                                'label' => 'Date',
                                'details' => '',
                                'value' => $date,
                                'placeholder' => '',
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('date1'),
                                'readonly' => false,
                                'fieldOnly' => false,
                            ])
                        </div>

                        <div id="dateSelect2" class="d-none">
                            @dateField([
                                'name' => 'date_from',
                                'label' => 'Date Range',
                                'details' => '',
                                'value' => $date_from,
                                'placeholder' => '',
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('from'),
                                'readonly' => false,
                                'fieldOnly' => false,
                            ])

                            <div class="d-flex">

                                <div class="flex-grow-0 p-2">
                                    @label([
                                        'for' => 'date_to',
                                        'label' => 'to',
                                    ])
                                </div>

                                <div class="flex-grow-1">

                                    @dateField([
                                        'name' => 'date_to',
                                        'label' => 'Date Range',
                                        'details' => '',
                                        'value' => $date_to,
                                        'placeholder' => '',
                                        'required' => false,
                                        'autofocus' => false,
                                        'error' => $errors->has('from'),
                                        'readonly' => false,
                                        'fieldOnly' => true,
                                    ])

                                </div>

                            </div>
                        </div>

                        <hr>

                        <button type="submit" class="btn btn-primary btn-sm">
                            {{ __('report.generate') }}
                        </button>
                    </form>

                </div>
            </div>

        </div>

        <div class="col-12 col-md-8 col-xl-9 print-full">

            @if ($compiledReport)

                <div class="row justify-content-center document-print-container">

                    <div class="col-12 col-md-10 document-container">

                        <div class="card shadow document">

                            <div class="card-body">

                                @include('reports._report', [
                                    'compiledReport' => $compiledReport,
                                ])

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection
