{{--
@userMultiSelectField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'values' => 'collection: the field's value',
    'users' => 'collection: collection of users to display in the field',
    'placeholder' => 'string: example placeholder text',
    'description' => 'string: additional details describing this field',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
    'fieldOnly' => 'boolean: whether the field should be wrapped in a div.form-group with label',
])
--}}
@unless($fieldOnly ?? false)
    <div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
        <label for="{{ $name }}">{{ $label }}</label>
        @if ($description ?? false)
            <p>{!! nl2br(e($description)) !!}</p>
        @endif
@endunless
    <select class="selectpicker show-tick form-control" id="{{ $name }}" name="{{ $name }}[]" title="{{ $placeholder }}" data-live-search="true" {{ ($readonly ?? false) ? 'disabled' : '' }} {{ ($autofocus ?? false) ? 'autofocus' : '' }} multiple>
        @foreach ($users as $user)
            <option value="{{ $user->id }}"{{ ($values->contains($user)) ? " selected" : "" }} data-content="{!! $user->icon() !!} {{ $user->name }}">{{ $user->name }}</option>
        @endforeach
    </select>
@unless($fieldOnly ?? false)
    </div>
@endunless
