<canvas class="of-chart-canvas" id="{{ $chart->getId() }}" height="{{ $chart->getHeight() }}" width="{{ $chart->getWidth() }}" data-chart-data='@json($chart)'>
    {{ $chart->getDescription() }}
</canvas>
