{{--

--}}

<h4 class="resultSet-name">{{ $resultSet->name }}</h4>

{{-- Visualizations here --}}

@foreach ($resultSet->visualizations() as $visualization)

    @if ($loop->first)
        <div class="row mb-5">
    @endif

    @include('reports._visualizations.' . $templateMapper->forVisualization($visualization), [
        'resultSet' => $resultSet,
        'visualization' => $visualization,
        'resolver' => app($resolverMapper->forVisualization($visualization)),
    ])

            {{--<div class="col-12 col-sm-6 mb-3">
                <div class="card h-100 visualization">

                    <div class="card-body">
                        @include('_component.chart')
                    </div>
                </div>
            </div>--}}

    @if ($loop->last)
        </div>
    @endif

@endforeach

<div class="table-responsive">
    <table class="table table-sm">
        <caption>
            {{ Str::plural($resultSet->dataset->datasetable->name) }}
            @foreach($resultSet->dataset->filters as $filter)
                @if($loop->first)
                    -
                @else
                    |
                @endif
                {{ $filterDescriptor->descriptorForFilter($filter) }}
            @endforeach
        </caption>
        <thead>
            <tr>
                @foreach($resultSet->headers() as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($resultSet->records() as $record)
                <tr>
                    <td>{{ $record->resource->name }}</td>

                    @foreach ($record->fields() as $field)
                        <td>{!! nl2br(e($field->label)) !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
