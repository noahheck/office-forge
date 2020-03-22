<?php

return [
    'file' => 'FileType',
    'file-types' => 'FileTypes',
    'name' => 'Name',
    'nameExamples' => 'Employee, Project, Customer, etc...',
    'icon' => 'Icon',
    'active' => 'Active',
    'active_description' => 'FileType types marked inactive can not have new FileTypes of that type created',


    'emptyFileType_description' => "FileTypes help you keep the information that's important to your business organized. They allow you to collect, track, and share all of the :fileTypeName information important to your organization.",
    'emptyFileType_openFirstNow' => 'Open your first :fileTypeName file now!',

    'fileOfTypeCreated' => ':fileTypeName file for :fileName created',
    'fileOfTypeUpdated' => ':fileTypeName file for :fileName updated',



    'error_invalidFileType' => 'Invalid file type provided',


    'forms' => 'Forms',
    'form' => 'Form',
    'form_name' => 'Name',
    'form_nameExamples' => 'Contact Information, References, Insurance, etc...',
    'form_teamAccessApproval' => 'Team Access Approval',
    'form_teamAccessApprovalDescription' => 'This form will only be accessible by members of these teams. If no teams are selected, this form will not be accessible by any of your staff.',
    'form_teamAccessApprovalShortDescription' => 'This form is only accessible by members of these teams.',
    'form_unrestrictedDescription' => 'This form has not been approved for access by any teams. It will not be accessible by any of your staff.',
    'form_active' => 'Active',
    'form_activeDescription' => 'Forms marked inactive will not appear on the File page for any files. You can re-activate a form if necessary; No data will be lost.',
    'form_noFormsToView' => "You don't have access to any Forms for this file.",
    'form_formDetailsUpdated' => ':formName details updated',

    'fields' => 'Fields',
    'field' => 'Field',
    'field_label' => 'Label',
    'field_labelDescription' => 'Identifies the value expected to be entered into the field',
    'field_labelExamples' => 'Name, Marital Status, Manufacturer, etc...',
    'field_description' => 'Description',
    'field_descriptionDescription' => 'Additional details to help staff fill in the correct value',
    'field_active' => 'Active',
    'field_activeDescription' => 'Fields marked inactive will not appear on any Form page for any files. You can re-activate a field if necessary; No data will be lost.',
    'field_separator' => 'Separator',
    'field_separatorDescription' => 'Visually distinguish sections of the form by outputting a horizontal line above this field.',


    'field_fieldType' => 'Field Type',
    'field_fieldTypeDescription' => '',



    'field_fieldTypeText' => 'Text Box',
    'field_fieldTypeTextarea' => 'Large Text Box',
    'field_fieldTypeEmail' => 'Email Address',
    'field_fieldTypeEmailPreviewPlaceholder' => 'john.doe@example.com',
    'field_fieldTypeDate' => 'Date',
    'field_fieldTypeDatePreviewPlaceholder' => date('m/d/Y'),

    'field_fieldTypeName' => 'Name',
    'field_fieldTypeNamePreviewFirstNamePlaceholder'  => 'First',
    'field_fieldTypeNamePreviewMiddleNamePlaceholder' => 'Middle',
    'field_fieldTypeNamePreviewLastNamePlaceholder'   => 'Last',
    'field_fieldTypeNamePreviewSuffixPlaceholder'     => 'Suffix',

    'field_fieldTypeAddress' => 'Address',
    'field_fieldTypeAddressPreviewLine1Placeholder' => 'Line 1',
    'field_fieldTypeAddressPreviewLine2Placeholder' => 'Line 2',
    'field_fieldTypeAddressPreviewCityPlaceholder' => 'City',
    'field_fieldTypeAddressPreviewStatePlaceholder' => 'State',
    'field_fieldTypeAddressPreviewZipPlaceholder' => 'Zip',

    'field_fieldTypePhone' => 'Phone Number',
    'field_fieldTypeMoney' => 'Monetary',
    'field_fieldTypeInteger' => 'Integer',
    'field_fieldTypeDecimal' => 'Decimal',
    'field_fieldTypeDecimal_numberOfDecimalPlaces' => 'Number of decimal places',

    'field_fieldTypeCheckbox' => 'Checkbox',
    'field_fieldTypeSelect' => 'Select Box',
    'field_fieldTypeSelect_options' => 'Options',
    'field_fieldTypeSelect_addOption' => 'Add Option',

    'field_fieldTypeUser' => 'User',
    'field_fieldTypeUser_memberOfTeam' => 'Member of Team',
    'field_fieldTypeUser_memberOfTeamDescription' => 'If selected, only members of the specified Team will be able to be selected',

    'field_fieldTypeFile' => 'File',
    'field_fieldTypeFile_fileType' => 'File Type',
    'field_fieldTypeFile_fileTypeDescription' => 'Specify the type of file that should be selected',
];
