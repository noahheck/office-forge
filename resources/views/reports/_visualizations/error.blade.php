@php
    $columnCounter->add(1);
@endphp
<div class="col-12 col-sm-6 mb-3">
    <div class="card h-100 visualization visualization-error">
        <div class="visualization-header">
            {{ $visualization->label }}
        </div>
        <div class="card-body text-center">
            <div>
                <strong>{{ __('app.error') }}</strong>
            </div>

            {{ __('report.visualizationTemplateNotFound') }}

        </div>
    </div>
</div>
