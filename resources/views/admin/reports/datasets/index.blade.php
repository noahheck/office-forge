@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Index($report),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\reports(['mr-2']) !!}{{ __('app.reports') }}
            </h1>

            <div class="card document">
                <div class="card-body">

                    <h2>{!! \App\icon\datasets(['mr-2']) !!}{{ __('report.datasets') }}</h2>

                    <hr>

                    <div class="mb-2">

                        <div class="text-right">
                            <a href="{{ route("admin.reports.datasets.create", [$report]) }}" class="btn btn-primary btn-sm">
                                {!! \App\Icon\circlePlus(['mr-2']) !!}{{ __('admin.newDataset') }}
                            </a>
                        </div>

                    </div>

                    @if ($datasets->count() > 0)
                        <div class="list-group">
                            @foreach ($report->datasets as $dataset)
                                <a class="list-group-item list-group-item-action" href="{{ route('admin.reports.datasets.show', [$report, $dataset]) }}">
                                    {{ $dataset->name }}
                                </a>
                            @endforeach
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
