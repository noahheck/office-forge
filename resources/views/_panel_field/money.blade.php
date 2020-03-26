<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        ${{ ($preview ?? false) ? \App\misc_money() : number_format($value->value_decimal, 2, '.', ',') }}
    </div>
</div>
