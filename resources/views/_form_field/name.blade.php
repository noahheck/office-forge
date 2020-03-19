<div class="form-group">
    <div class="form-row mb-3">
        <div class="col-12">
            <label for="{{ $field->id }}_1">{{ $field->label }}</label>
        </div>
        <div class="col-8">
            <input type="text" class="form-control {{ ($errors->has($field->id) ?? false) ? 'is-invalid' : '' }}" name="{{ $field->id }}_1" id="{{ $field->id }}_1" value="{{ old($field->id . '_1', $value->value_text1) }}" placeholder="First" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
        <div class="col-4">
            <input type="text" class="form-control {{ ($errors->has($field->id) ?? false) ? 'is-invalid' : '' }}" name="{{ $field->id }}_2" id="{{ $field->id }}_2" value="{{ old($field->id . '_2', $value->value_text2) }}" placeholder="Middle" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
    </div>
    <div class="form-row">
        <div class="col-8">
            <input type="text" class="form-control {{ ($errors->has($field->id) ?? false) ? 'is-invalid' : '' }}" name="{{ $field->id }}_3" id="{{ $field->id }}_3" value="{{ old($field->id . '_3', $value->value_text3) }}" placeholder="Last" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
        <div class="col-4">
            <input type="text" class="form-control {{ ($errors->has($field->id) ?? false) ? 'is-invalid' : '' }}" name="{{ $field->id }}_4" id="{{ $field->id }}_4" value="{{ old($field->id . '_4', $value->value_text4) }}" placeholder="Suffix" {{ ($readonly ?? false) ? 'readonly' : '' }}>
        </div>
    </div>
</div>
