<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {{ ($preview ?? false) ? \App\misc_decimal($field->decimalPlaces()) : number_format($value->value_decimal, $field->decimalPlaces(), '.', ',') }}
    </div>
</div>
