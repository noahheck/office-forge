<div class="field numeric-field-group">
    <div class="d-flex">
        <span class="flex-grow-1 field-label">{{ $field->label }}</span>
        <div class="flex-grow-0 field-value">
        {{ ($preview ?? false) ? \App\misc_decimal($field->decimalPlaces()) : is_null($value->value_decimal) ? '' : number_format($value->value_decimal, $field->decimalPlaces(), '.', ',') }}
        </div>
    </div>

    @if($field->description)
        <p>{{ nl2br(e($field->description)) }}</p>
    @endif

</div>
