<div class="form-group">
    <div class="form-row">
        <div class="col-12">
            <label for="{{ $field->fieldName() }}_1">{{ $field->label }}</label>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <input type="text" class="form-control {{ ($errors->has($field->fieldName() . '_1') ?? false) ? 'is-invalid' : '' }}" name="{{ $field->fieldName() }}_1" id="{{ $field->fieldName() }}_1" value="{{ old($field->fieldName() . '_1', $value->value_text1) }}" placeholder="{{ __('file.field_fieldTypeAddressPreviewLine1Placeholder') }}" {{ ($readonly ?? false) ? 'readonly' : '' }} {{ ($autofocus ?? false) ? 'autofocus' : '' }}>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <input type="text" class="form-control {{ ($errors->has($field->fieldName() . '_2') ?? false) ? 'is-invalid' : '' }}" name="{{ $field->fieldName() }}_2" id="{{ $field->fieldName() }}_2" value="{{ old($field->fieldName() . '_2', $value->value_text2) }}" placeholder="{{ __('file.field_fieldTypeAddressPreviewLine2Placeholder') }}" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
    </div>
    <div class="form-row">
        <div class="col-12 col-md-6 mb-3">
            <input type="text" class="form-control {{ ($errors->has($field->fieldName() . '_3') ?? false) ? 'is-invalid' : '' }}" name="{{ $field->fieldName() }}_3" id="{{ $field->fieldName() }}_3" value="{{ old($field->fieldName() . '_3', $value->value_text3) }}" placeholder="{{ __('file.field_fieldTypeAddressPreviewCityPlaceholder') }}" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <select class="selectpicker show-tick form-control" id="{{ $field->fieldName() }}_4" name="{{ $field->fieldName() }}_4" title="{{ __('file.field_fieldTypeAddressPreviewStatePlaceholder') }}" data-live-search="true" {{ ($readonly ?? false) ? 'disabled' : '' }}>
                <option value="">--</option>
                @foreach (\App\Enum\USStates::statesIndexedByAbbreviation() as $abbr => $state)
                    <option value="{{ $abbr }}" {{ (old($field->fieldName() . '_4', $value->value_text4) == $abbr) ? "selected" : "" }}>{{ $abbr }} - {{ $state }}</option>
                @endforeach
            </select>

</div>
<div class="col-6 col-md-3">
    <input type="text" class="form-control {{ ($errors->has($field->fieldName() . '_5') ?? false) ? 'is-invalid' : '' }}" name="{{ $field->fieldName() }}_5" id="{{ $field->fieldName() }}_5" value="{{ old($field->fieldName() . '_5', $value->value_text5) }}" placeholder="{{ __('file.field_fieldTypeAddressPreviewZipPlaceholder') }}" {{ ($readonly ?? false) ? 'readonly' : '' }}>
</div>
    </div>
</div>

@errors($field->fieldName() . '_1', $field->fieldName() . '_2', $field->fieldName() . '_3', $field->fieldName() . '_4', $field->fieldName() . '_5')
