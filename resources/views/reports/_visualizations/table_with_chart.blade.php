@php
    $visData = $resolver->resolve($resultSet, $visualization);
    $chart = $visData['chart'];
    $table = $visData['table'];
@endphp
<div class="col-12 mb-3">
    <div class="card h-100 visualization">
        <div class="visualization-header">
            {{ $visualization->label }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 order-1 order-md-2">
                    @include('_component.chart', ['chart' => $visData['chart']])
                </div>
                <div class="col-12 col-md-6 order-2 order-md-1">
                    @foreach ($table->getRecords() as $record)

                        @if ($loop->first)
                            <table class="table table-sm">
                                <tr>
                                    @foreach ($table->getHeaders() as $header)
                                        <th class="border-0">{{ $header }}</th>
                                    @endforeach
                                </tr>
                        @endif
                        <tr>

                            @foreach ($record as $field)
                                <td>{!! ($field) ? e($field) : '<em>&lt;' . __('app.noValue') . '&gt;</em>' !!}</td>
                            @endforeach

                        </tr>
                        @if ($loop->last)
                            </table>
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
