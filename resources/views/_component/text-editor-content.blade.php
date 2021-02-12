{{--
@textEditorContent([
    'content' => 'string: raw text editor field content',
    'classes' => [],// array: classes to add to the containing div element
])
--}}
<div class="editor-content {{ implode(' ', $classes ?? []) }}">
    {!! App\safe_text_editor_content($content) !!}
</div>
