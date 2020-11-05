@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Index(),
])

@section('content')
    <h1>
        {!! \App\icon\reports(['mr-2']) !!}{{ __('app.reports') }}
    </h1>


    @if (count($reports) > 0)
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('admin.reports.create') }}" class="btn btn-primary">
                        {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newReport') }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="reports" class="table table-striped table-bordered dt-table" data-order='[[ 0, "asc" ]]'>
                        <thead>
                            <tr>
                                <th>{{ __('report.name') }}</th>
                                <th class="w-100p">{{ __('app.fileType') }}</th>
                                <th class="w-50p">{{ __('report.active') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td data-sort="{{ $report->name }}" data-search="{{ $report->name }}">
                                        <a href="{{ route('admin.reports.show', [$report]) }}">
                                            {{ $report->name }}
                                        </a>
                                    </td>
                                    @if ($__fileType = $report->fileType)
                                        <td data-sort="{{ $__fileType->name }}">
                                            {!! $__fileType->icon() !!}&nbsp;{{ $__fileType->name }}
                                        </td>
                                    @else
                                        <td data-sort="">

                                        </td>
                                    @endif
                                    <td class="text-center" data-order="{{ $report->active ? '1' : '0' }}">
                                        @if ($report->active)
                                            {!! \App\icon\checkedBox() !!}
                                        @else
                                            {!! \App\icon\uncheckedBox() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">

            <div class="col-12 col-md-6 col-lg-6 col-xl-5">

                <div class="card">
                    <div class="card-body text-center">

                        <div class="empty-resource">
                            {!! \App\icon\reports(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.report_description') }}</p>

                        <hr>

                        <a class="btn btn-primary" href="{{ route('admin.reports.create') }}">{{ __('admin.report_createFirstReportNow') }}</a>
                    </div>
                </div>

            </div>

        </div>
    @endif
@endsection
