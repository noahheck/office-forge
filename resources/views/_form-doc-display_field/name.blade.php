<div class="field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {{ ($preview ?? false) ? \App\misc_name() : $value->valueName() }}
    </div>
</div>
