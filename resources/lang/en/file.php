<?php

return [
    'file' => 'FileType',
    'file-types' => 'FileTypes',
    'name' => 'Name',
    'nameExamples' => 'Employee, Project, Customer, etc...',
    'icon' => 'Icon',
    'teamAccessRestriction' => 'Team Access Restrictions',
    'teamAccess' => 'Team Access',
    'teamAccessRestrictionShortDescription' => 'These files are only accessible by members of these teams.',
    'teamAccessUnrestrictedShortDescription' => 'These files are accessible by all staff members.',
    'teamAccessRestrictionDescription' => 'These files will only be accessible by members of these teams. If no teams are selected, these files will be accessible by all of your staff.',
    'active' => 'Active',
    'active_description' => 'FileType types marked inactive can not have new FileTypes of that type created',

    'createdDate' => 'Created Date',
    'createdBy' => 'Created By',

    'emptyFileType_description' => "FileTypes help you keep the information that's important to your business organized. They allow you to collect, track, and share all of the :fileTypeName information important to your organization.",
    'emptyFileType_openFirstNow' => 'Open your first :fileTypeName file now!',

    'fileOfTypeCreated' => ':fileTypeName file for :fileName created',
    'fileOfTypeUpdated' => ':fileTypeName file for :fileName updated',



    'error_invalidFileType' => 'Invalid file type provided',
    'error_unableToAccessFileType' => 'You are unable to access these files',


    'myFiles' => 'My Files',
    'myFilesDescription' => 'My Files is a list of Files you want quick access to right from your Home Screen. Add Files to this list that you work with most often to access them anytime!',
    'addToMyFiles' => 'Add To My Files',
    'removeFromMyFiles' => 'Remove From My Files',
    'inMyFiles' => 'In My Files',


    'accessLocks' => 'Access Locks',
    'accessKeys' => 'Access Keys',
    'accessLock_name' => 'Name',
    'accessLock_nameExamples' => 'Marketing Dept, Northwest Region, Warehousing, etc...',
    'accessLock_details' => 'Details',
    'accessLock_detailsDescription' => 'Additional information regarding the purpose of this Access Lock. This will be shown to staff when deciding which Access Locks to assign to Files, so feel free to be descriptive.',
    'accessLocksShortDescription' => 'These files are optionally restricted to users allowed to open these locks.',
    'accessLocksUnrestrictedShortDescription' => 'These files will be accessible by all members of any of the allowed Teams.',

    'accessLockUnrestrictedShortDescription' => 'This file has no Access Locks assigned to it.',
    'viewAccessDetails' => 'View Access Details',
    'filesOfTypeNoTeamRestrictions' => ':type Files have no Team access restrictions.',
    'filesOfTypeRestrictedByTeams' => ':type Files are restricted for access to members of these Teams:',
    'fileOfTypeNoAccessLockRestrictions' => 'This :type File is not restricted by any Access Locks.',
    'fileOfTypeRestrictedByAccessLocks' => 'This :type File is restricted to users with Keys for one of these Access Locks:',
    'fileOfTypeAccessibleByUsers' => 'This :type File is accessible by these Staff Members:',

    'backToFileType' => 'Back to :fileType',

    'forms' => 'Forms',
    'form' => 'Form',
    'form_name' => 'Name',
    'form_nameExamples' => 'Contact Information, References, Insurance, etc...',
    'form_teamAccessApproval' => 'Team Access Approval',
    'form_teamAccessApprovalDescription' => 'This form will only be accessible by members of these teams. If no teams are selected, this form will be accessible by all of your staff.',
    'form_teamAccessApprovalShortDescription' => 'This form is only accessible by members of these teams.',
    'form_unrestrictedDescription' => 'This form is accessible by all of your staff.',
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

    'field_fieldTypeRange' => 'Range',
    'field_fieldTypeRange_minimumValue' => 'Minimum Value',
    'field_fieldTypeRange_maximumValue' => 'Maximum Value',
    'field_fieldTypeRange_lowLabel' => 'Low-end Label',
    'field_fieldTypeRange_lowLabelExamples' => 'Low, 0, etc...',
    'field_fieldTypeRange_highLabel' => 'High-end Label',
    'field_fieldTypeRange_highLabelExamples' => 'High, 10, etc...',



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

    'field_fieldTypeSectionHeader' => 'Section Header',


    'details' => 'Details',
    'panels' => 'Panels',
    'panel' => 'Panel',
    'panel_name' => 'Name',
    'panel_nameExamples' => 'Contact Information, References, Insurance, etc...',
    'panel_teamAccessApproval' => 'Team Access Approval',
    'panel_teamAccessApprovalDescription' => 'This panel will only be accessible by members of these teams. If no teams are selected, this panel will be accessible by all of your staff.',
    'panel_teamAccessApprovalShortDescription' => 'This panel is only accessible by members of these teams.',
    'panel_unrestrictedDescription' => 'This panel is accessible by all of your staff.',
    'panel_addField' => 'Add Field',

    'formDocs' => 'FormDocs',
    'formDoc' => 'FormDoc',
    'formDoc_name' => 'Name',
    'formDoc_nameExamples' => 'Progress Update, Shift Report, etc...',
    'formDoc_active' => 'Active',

    'formDoc_noFormDocsForThisFileType' => 'There are no FormDocs for you to fill out for this :fileType',


    'reports_noReportsToView' => "You don't have access to any Reports for this file.",

];
