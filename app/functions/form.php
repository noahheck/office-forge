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
