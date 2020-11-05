<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    @if ($field->description ?? false)
        <p class="mb-0"><em>{{ $field->description }}</em></p>
    @endif
    <div class="field-value">
        {{ ($preview ?? false) ? \App\misc_integer($field->rangeMin(), $field->rangeMax()) : $value->value_integer }} / {{ $field->rangeMax() }}
    </div>
</div>
