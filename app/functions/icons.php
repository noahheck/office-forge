<?php

namespace App\icon;



function filetype_field_preview_text(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return "<input type='text' class='form-control' readonly>";
}

function filetype_field_preview_textarea(array $withClasses = []) {
    $addlClasses = implode(' ', $withClasses);

    return "<textarea class='form-control' readonly rows='3'></textarea>";
}
