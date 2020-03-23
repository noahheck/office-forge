<div class="form-group">
    <div class="form-row mb-3">
        <div class="col-12">
            <label for="{{ $field->fieldName() }}_1">{{ $field->label }}</label>
        </div>
        <div class="col-8">
            <input type="text" class="form-control {{ ($errors->has($field->fieldName() . '_1') ?? false) ? 'is-invalid' : '' }}" name="{{ $field->fieldName() }}_1" id="{{ $field->fieldName() }}_1" value="{{ old($field->fieldName() . '_1', $value->value_text1) }}" placeholder="{{ __('file.field_fieldTypeNamePreviewFirstNamePlaceholder') }}" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
        <div class="col-4">
            <input type="text" class="form-control {{ ($errors->has($field->fieldName() . '_2') ?? false) ? 'is-invalid' : '' }}" name="{{ $field->fieldName() }}_2" id="{{ $field->fieldName() }}_2" value="{{ old($field->fieldName() . '_2', $value->value_text2) }}" placeholder="{{ __('file.field_fieldTypeNamePreviewMiddleNamePlaceholder') }}" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
    </div>
    <div class="form-row">
        <div class="col-8">
            <input type="text" class="form-control {{ ($errors->has($field->fieldName() . '_3') ?? false) ? 'is-invalid' : '' }}" name="{{ $field->fieldName() }}_3" id="{{ $field->fieldName() }}_3" value="{{ old($field->fieldName() . '_3', $value->value_text3) }}" placeholder="{{ __('file.field_fieldTypeNamePreviewLastNamePlaceholder') }}" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
        <div class="col-4">
            <input type="text" class="form-control {{ ($errors->has($field->fieldName() . '_4') ?? false) ? 'is-invalid' : '' }}" name="{{ $field->fieldName() }}_4" id="{{ $field->fieldName() }}_4" value="{{ old($field->fieldName() . '_4', $value->value_text4) }}" placeholder="{{ __('file.field_fieldTypeNamePreviewSuffixPlaceholder') }}" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
    </div>
</div>

@errors($field->fieldName() . '_1', $field->fieldName() . '_2', $field->fieldName() . '_3', $field->fieldName() . '_4')
