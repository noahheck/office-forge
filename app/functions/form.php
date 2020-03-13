<?php

namespace App\form;



function filetype_field_preview_text(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return "<input type='text' class='form-control' readonly>";
}

function filetype_field_preview_textarea(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return "<textarea class='form-control' readonly rows='3'></textarea>";
}

function filetype_field_preview_email(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return "<input type='email' class='form-control' readonly placeholder='" . __('file.field_fieldTypeEmailPreviewPlaceholder') . "'>";
}

function filetype_field_preview_date(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return "<input type='text' class='form-control' readonly placeholder='" . __('file.field_fieldTypeDatePreviewPlaceholder') . "'>";
}

function filetype_field_preview_name(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return <<<EOT
<div class="form-row mb-3">
    <div class="col-8">
        <input type='text' class='form-control' readonly placeholder='First'>
    </div>
    <div class="col-4">
        <input type='text' class='form-control' readonly placeholder='Middle'>
    </div>
</div>
<div class="form-row">
    <div class="col-8">
        <input type='text' class='form-control' readonly placeholder='Last'>
    </div>
    <div class="col-4">
        <input type='text' class='form-control' readonly placeholder='Suffix'>
    </div>
</div>
EOT;
}
