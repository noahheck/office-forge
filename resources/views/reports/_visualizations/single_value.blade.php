@php
$columnCounter->add(1);
@endphp
<div class="col-12 col-sm-6 mb-3">
    <div class="card h-100 visualization">
        <div class="visualization-header">
            {{ $visualization->label }}
        </div>
        <div class="card-body text-center">
            <span class="display-3">
                {{ $resolver->resolve($resultSet, $visualization) }}
            </span>
        </div>
    </div>
</div>
