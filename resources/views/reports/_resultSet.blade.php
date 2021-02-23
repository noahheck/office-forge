@php
    /**
     * $columnCounter is used to track how many columns we've output with each Visualization so we can end a row and
     * start a new one so the Visualizations don't get pushed to a new page unnecessarily
     */
    $columnCounter = new \App\Utility\Counter;
@endphp
<h4 class="resultSet-name">{{ $resultSet->name }}</h4>

@foreach ($resultSet->visualizations() as $visualization)

    @if ($loop->first)
        <div class="row">
    @endif

    @include('reports._visualizations.' . $templateMapper->forVisualization($visualization), [
        'resultSet' => $resultSet,
        'visualization' => $visualization,
        'resolver' => app($resolverMapper->forVisualization($visualization)),
    ])

    @if ($columnCounter->isEven() && !$loop->last)
        </div>
        <div class="row">
    @endif

    @if ($loop->last)
        </div>
    @endif

@endforeach

<div class="table-responsive mt-5">
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
