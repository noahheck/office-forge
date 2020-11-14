@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Filters\Index($report, $dataset),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h3>
                {!! \App\icon\datasets(['mr-2']) !!}{{ $dataset->name }}
            </h3>

            <div class="card document">
                <div class="card-body">

                    <h2>{!! \App\icon\filters(['mr-2']) !!}{{ __('report.filters') }}</h2>

                    <hr>

                    <div class="mb-2">

                        <div class="text-right">
                            <a href="{{ route("admin.reports.datasets.filters.create", [$report, $dataset]) }}" class="btn btn-primary btn-sm">
                                {!! \App\Icon\circlePlus(['mr-2']) !!}{{ __('admin.newFilter') }}
                            </a>
                        </div>

                    </div>

                    @if ($filters->count() > 0)
                        <div class="list-group">
                            @foreach ($filters as $filter)
                                <a class="list-group-item list-group-item-action" href="{{ route('admin.reports.datasets.filters.show', [$report, $dataset, $filter]) }}">
                                    $filter->name or something
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-resource">
                            {!! \App\icon\filters(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.filter_description') }}</p>

                        <hr>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.reports.datasets.filters.create', [$report, $dataset]) }}">{{ __('admin.filter_createFirstFilterNow') }}</a>
                        </p>
                    @endif

                </div>
            </div>

        </div>

    </div>

@endsection
