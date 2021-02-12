@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Visualizations\Index($report, $dataset),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h3>
                {!! \App\icon\datasets(['mr-2']) !!}{{ $dataset->name }}
            </h3>

            <div class="card document">
                <div class="card-body">

                    <h2>{!! \App\icon\visualizations(['mr-2']) !!}{{ __('report.visualizations') }}</h2>

                    <hr>

                    <div class="mb-2">

                        <div class="text-right">
                            <a href="{{ route("admin.reports.datasets.visualizations.create", [$report, $dataset]) }}" class="btn btn-primary btn-sm">
                                {!! \App\Icon\circlePlus(['mr-2']) !!}{{ __('admin.dataset_newVisualization') }}
                            </a>
                        </div>

                    </div>

                    @if ($visualizations->count() > 0)
                        <div class="list-group">
                            @foreach ($visualizations as $visualization)
                                <a class="list-group-item list-group-item-action" href="{{ route('admin.reports.datasets.visualizations.edit', [$report, $dataset, $visualization]) }}">
                                    {!! \App\icon\visualizations(['fa-fw', 'mr-2']) !!}{{ $visualization->label }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-resource">
                            {!! \App\icon\visualizations(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.dataset_visualization_description') }}</p>

                        <hr>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.reports.datasets.visualizations.create', [$report, $dataset]) }}">{{ __('admin.dataset_visualization_createFirstFieldNow') }}</a>
                        </p>
                    @endif

                </div>
            </div>

        </div>

    </div>

@endsection
