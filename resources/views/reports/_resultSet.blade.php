{{--

--}}
<h4 class="resultSet-name">{{ $resultSet->name }}</h4>

{{-- Visualizations here --}}

@foreach ($resultSet->visualizations() as $visualization)

    @if ($loop->first)
        <div class="row mb-5">
    @endif

    @includeIf('reports._visualizations.' . $visualization->type, [
        'resultSet' => $resultSet,
        'visualization' => $visualization,
    ])

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
