@extends("files.file_resource")

@if ($compiledReport)

@section('title')
    {{ $compiledReport->title }}
@endsection

@endif

@push('styles')
    @style('css/files.css')
    @style('css/document.css')
    @style('css/reports.css')
@endpush

@push('scripts')
    @script('js/page._reports.js')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Reports\Index($fileType, $file)),
])

@section('resource-content')

    <div class="card shadow document">

        <div class="card-body">

            <h2 class="h4">
                {!! \App\icon\reports(['mr-2']) !!}{{ __('app.reports') }}
            </h2>

            <hr>

            @if ($reports->count() > 0)

                <form action="{{ route("files.reports", [$file]) }}" method="GET" class="bold-labels">

                    <div class="form-group">
                        @label([
                            'for' => 'report_id',
                            'label' => __('report.selectAReport'),
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

                    <div id="userSelect" class="d-none d-flex">

                        <div class="flex-grow-0 p-2">
                            @label([
                                'for' => 'user_id',
                                'label' => __('app.user'),
                            ])
                        </div>

                        <div class="flex-grow-1">

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
                                'fieldOnly' => true,
                            ])
                        </div>

                    </div>

                    <div id="dateSelect1" class="d-none d-flex">

                        <div class="flex-grow-0 p-2">
                            @label([
                                'for' => 'date',
                                'label' => __('app.date'),
                            ])
                        </div>

                        <div class="flex-grow-1">

                            @dateField([
                                'name' => 'date',
                                'label' => __('app.date'),
                                'details' => '',
                                'value' => $date,
                                'placeholder' => '',
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('date1'),
                                'readonly' => false,
                                'fieldOnly' => true,
                            ])

                        </div>

                    </div>

                    <div id="dateSelect2" class="d-none d-flex">

                        <div class="flex-grow-0 p-2">
                            @label([
                                'for' => 'date_from',
                                'label' => __('report.dateRange'),
                            ])
                        </div>

                        <div class="flex-grow-1">

                            @dateField([
                                'name' => 'date_from',
                                'label' => __('report.dateRange'),
                                'details' => '',
                                'value' => $date_from,
                                'placeholder' => '',
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('from'),
                                'readonly' => false,
                                'fieldOnly' => true,
                            ])

                        </div>

                        <div class="flex-grow-0 p-2">
                            @label([
                                'for' => 'date_to',
                                'label' => __('app.to'),
                            ])
                        </div>

                        <div class="flex-grow-1">

                            @dateField([
                                'name' => 'date_to',
                                'label' => '',
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

                    <hr>

                    <button type="submit" class="btn btn-primary btn-sm">
                        {{ __('report.generate') }}
                    </button>
                </form>

            @else

                <p>{{ __('admin.report_description') }}</p>

                <hr>

                <p><em>{{ __('file.reports_noReportsToView') }}</em></p>

            @endif

        </div>

    </div>

    @if ($compiledReport)

        <div class="d-flex justify-content-center document-print-container mt-4">

            <div class="document-container">

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



@endsection
