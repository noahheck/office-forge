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

function filetype_field_preview_phone(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return <<<EOT
<div class='input-group'>
    <div class="input-group-prepend">
        <div class="input-group-text">
            <span class="fas fa-phone"></span>
        </div>
    </div>
    <input type='text' class='form-control' readonly placeholder='(123) 456-7890'>
</div>
EOT;
}

function filetype_field_preview_money(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return <<<EOT
<div class='input-group'>
    <div class="input-group-prepend">
        <div class="input-group-text">
            <span class="fas fa-dollar-sign"></span>
        </div>
    </div>
    <input type='text' class='form-control' readonly placeholder='1234.56'>
</div>
EOT;
}


function filetype_field_preview_name(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    $firstNamePlaceholder  = __('file.field_fieldTypeNamePreviewFirstNamePlaceholder');
    $middleNamePlaceholder = __('file.field_fieldTypeNamePreviewMiddleNamePlaceholder');
    $lastNamePlaceholder   = __('file.field_fieldTypeNamePreviewLastNamePlaceholder');
    $suffixPlaceholder     = __('file.field_fieldTypeNamePreviewSuffixPlaceholder');

    return <<<EOT
<div class="form-row mb-3">
    <div class="col-8">
        <input type='text' class='form-control' readonly placeholder='{$firstNamePlaceholder}'>
    </div>
    <div class="col-4">
        <input type='text' class='form-control' readonly placeholder='{$middleNamePlaceholder}'>
    </div>
</div>
<div class="form-row">
    <div class="col-8">
        <input type='text' class='form-control' readonly placeholder='{$lastNamePlaceholder}'>
    </div>
    <div class="col-4">
        <input type='text' class='form-control' readonly placeholder='{$suffixPlaceholder}'>
    </div>
</div>
EOT;
}

function filetype_field_preview_address(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    $line1Placeholder = __('file.field_fieldTypeAddressPreviewLine1Placeholder');
    $line2Placeholder = __('file.field_fieldTypeAddressPreviewLine2Placeholder');
    $cityPlaceholder  = __('file.field_fieldTypeAddressPreviewCityPlaceholder');
    $statePlaceholder = __('file.field_fieldTypeAddressPreviewStatePlaceholder');
    $zipPlaceholder   = __('file.field_fieldTypeAddressPreviewZipPlaceholder');


    return <<<EOT
<div class="form-row">
    <div class="col-12 col-md-6 mb-3">
        <input type='text' class='form-control' readonly placeholder='{$line1Placeholder}'>
    </div>
    <div class="col-12 col-md-6 mb-3">
        <input type='text' class='form-control' readonly placeholder='{$line2Placeholder}'>
    </div>
</div>
<div class="form-row">
    <div class="col-12 col-md-6 mb-3">
        <input type='text' class='form-control' readonly placeholder='{$cityPlaceholder}'>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <input type='text' class='form-control' readonly placeholder='{$statePlaceholder}'><span class="fas fa-sort" style="position: absolute; top: 12px; right: 12px;"></span>
    </div>
    <div class="col-6 col-md-3">
        <input type='text' class='form-control' readonly placeholder='{$zipPlaceholder}'>
    </div>
</div>
EOT;

}
