<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {{ ($preview ?? false) ? '$' . \App\misc_money() : (is_null($value->value_decimal) ? '' : '$' . \App\format_money($value->value_decimal)) }}
    </div>
</div>
