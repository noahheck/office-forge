{{--
@textEditorField([
    'name' => 'string: form field name',
    'id' => 'string: unique id for this editor instance',
    'label' => 'string: text label for form field',
    'required' => 'boolean: whether the field is required',
    'value' => 'string: the field's value',
    'placeholder' => 'string: example placeholder text',
    'description' => 'string: additional details describing this field',
    'toolbar' => 'string: type of toolbar to display; full || minimal',
    'resourceType' => 'string: classname for the resource entity - used for managing image uploads; e.g. get_class($announcement)',
    'resourceId' => 'integer: resource entity id - used for managing image uploads; e.g. $announcement->id',
])
--}}
@php
    $__tempId = App\temp_id();
    $toolbar = $toolbar ?? 'minimal';// full, minimal
@endphp
<div class="editor-container">
    <label for="{{ $id }}">{{ $label }}</label>
    @if ($description ?? false)
        <p>{!! nl2br(e($description)) !!}</p>
    @endif
    <trix-toolbar id="{{ $id }}__toolbar">
        <div class="trix-button-row">
            @if ($toolbar === 'full')
                <span class="trix-button-group">
                    <button type="button" class="trix-button" data-trix-attribute="heading1" title="Heading" tabindex="-1"><span class="fas fa-heading"></span></button>
                    <button type="button" class="trix-button" data-trix-attribute="heading2" title="Sub-heading" tabindex="-1"><span class="fas fa-sm fa-heading"></span></button>
                </span>
            @endif

            <span class="trix-button-group">
                <button type="button" class="trix-button" data-trix-attribute="bold" data-trix-key="b" title="Bold" tabindex="-1"><span class="fas fa-bold"></span></button>
                <button type="button" class="trix-button" data-trix-attribute="italic" data-trix-key="i" title="Italic" tabindex="-1"><span class="fas fa-italic"></span></button>
                <button type="button" class="trix-button" data-trix-attribute="underline" data-trix-key="u" title="Underline" tabindex="-1"><span class="fas fa-underline"></span></button>
                <button type="button" class="trix-button" data-trix-attribute="href" data-trix-action="link" data-trix-key="k" title="Link" tabindex="-1"><span class="fas fa-link"></span></button>
            </span>

            @if ($toolbar === 'full')
                <span class="trix-button-group">

                    {{--<button type="button" class="trix-button" data-trix-action="x-horizontal-rule" title="Horizontal Rule" tabindex="-1"><span class="fas fa-quote-right"></span></button>--}}
                    <button type="button" class="trix-button" data-trix-attribute="quote" title="Quote" tabindex="-1"><span class="fas fa-quote-right"></span></button>
                    <button type="button" class="trix-button" data-trix-attribute="code" title="Code" tabindex="-1"><span class="fas fa-code"></span></button>
                    <button type="button" class="trix-button" data-trix-attribute="bullet" title="Bulleted List" tabindex="-1"><span class="fas fa-list-ul"></span></button>
                    <button type="button" class="trix-button" data-trix-attribute="number" title="Numbered List" tabindex="-1"><span class="fas fa-list-ol"></span></button>
                    <button type="button" class="trix-button" data-trix-action="decreaseNestingLevel" title="Decrease Indent" tabindex="-1"><span class="fas fa-outdent"></span></button>
                    <button type="button" class="trix-button" data-trix-action="increaseNestingLevel" title="Increase Indent" tabindex="-1"><span class="fas fa-indent"></span></button>

                </span>

                <span class="trix-button-group">

                    <button type="button" class="trix-button" data-trix-action="attachFiles" title="Add Image" tabindex="-1"><span class="far fa-image"></span></button>

                </span>
            @endif

            <span class="trix-button-group trix-button-group--history-tools" data-trix-button-group="history-tools">
                <button type="button" class="trix-button" data-trix-action="undo" data-trix-key="z" title="Undo" tabindex="-1"><span class="fas fa-undo"></span></button>
                <button type="button" class="trix-button" data-trix-action="redo" data-trix-key="shift+z" title="Redo" tabindex="-1"><span class="fas fa-redo"></span></button>
            </span>

        </div>

        <div class="trix-dialogs" data-trix-dialogs>
            <div class="trix-dialog trix-dialog--link" data-trix-dialog="href" data-trix-dialog-attribute="href">
                <div class="trix-dialog__link-fields">
                    <input type="url" name="href" value="https://" class="trix-input trix-input--dialog" placeholder="Enter a URL…" aria-label="URL" required="" data-trix-input="" disabled="disabled">
                    <div class="trix-button-group">
                        <input type="button" class="trix-button trix-button--dialog" value="Link" data-trix-method="setAttribute">
                        <input type="button" class="trix-button trix-button--dialog" value="Unlink" data-trix-method="removeAttribute">
                    </div>
                </div>
            </div>
        </div>

    </trix-toolbar>
    <input type="hidden" id="temp_id_{{ $name }}" name="temp_id" value="{{ $__tempId }}">
    <input type="hidden" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}">
    <trix-editor class="editor-content" id="{{ $id }}__editor" input="{{ $id }}" toolbar="{{ $id }}__toolbar" placeholder="{{ $placeholder ?? '' }}" {{ ($toolbar === "full") ? "data-accept-images='true'" : "" }} data-resource-type="{{ $resourceType }}" data-resource-id="{{ ($resourceId) ? $resourceId : '' }}" data-resource-temp-id="{{ $__tempId }}"></trix-editor>
</div>
