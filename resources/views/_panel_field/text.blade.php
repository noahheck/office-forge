<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {{ ($preview ?? false) ? __('file.field_fieldTypeTextPreviewPlaceholder') : $value->value_text1 }}
    </div>
</div>
