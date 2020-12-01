{{--

--}}
<h4>{{ $dataset->name }}</h4>

{{-- Visualizations here --}}

<div class="table-responsive">
    <table class="table table-sm">
        <caption>
            {{ Str::plural($dataset->datasetable->name) }}
            @foreach($dataset->filters as $filter)
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
                @foreach($datasetRenderer->headers($dataset) as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($datasetRenderer->records($dataset) as $record)
                <tr>
                    @foreach ($record as $column)
                        <td>{{ $column }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
