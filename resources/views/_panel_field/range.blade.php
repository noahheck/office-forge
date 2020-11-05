<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {{ ($preview ?? false) ? \App\misc_integer($field->rangeMin(), $field->rangeMax()) : $value->value_integer }}
    </div>
</div>
