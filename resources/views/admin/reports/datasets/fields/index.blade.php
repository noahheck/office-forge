@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Reports\Datasets\Fields\Index($report, $dataset),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h3>
                {!! \App\icon\datasets(['mr-2']) !!}{{ $dataset->name }}
            </h3>

            <div class="card document">
                <div class="card-body">

                    <h2>{!! \App\icon\datasetFields(['mr-2']) !!}{{ __('report.fields') }}</h2>

                    <hr>

                    <div class="mb-2">

                        <div class="text-right">
                            <a href="{{ route("admin.reports.datasets.fields.create", [$report, $dataset]) }}" class="btn btn-primary btn-sm">
                                {!! \App\Icon\circlePlus(['mr-2']) !!}{{ __('admin.newField') }}
                            </a>
                        </div>

                    </div>

                    @if ($fields->count() > 0)
                        <div class="list-group">
                            @foreach ($fields as $field)
                                <a class="list-group-item list-group-item-action" href="{{ route('admin.reports.datasets.fields.edit', [$report, $dataset, $field]) }}">
                                    {!! $dataset->datasetable->icon(['fa-fw', 'mr-2']) !!}{{ $field->label }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-resource">
                            {!! \App\icon\datasetFields(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.dataset_field_description') }}</p>

                        <hr>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.reports.datasets.fields.create', [$report, $dataset]) }}">{{ __('admin.dataset_field_createFirstFieldNow') }}</a>
                        </p>
                    @endif

                </div>
            </div>

        </div>

    </div>

@endsection
