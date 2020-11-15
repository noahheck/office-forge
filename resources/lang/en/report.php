<?php

return [

    'name' => 'Name',
    'description' => 'Description',
    'active' => 'Active',


    'nameExamples' => 'TPS Report, Daily Activity Report, Inquiry Summary, etc...',
    'descriptionDescription' => 'Describe the purpose of this report. This information will appear at the top of the report each time it is generated. Include details on how to use the information in the report to help guide business decisions and activities.',
    'descriptionExample' => 'Describe this report...',
    'activeDescription' => 'Reports marked inactive cannot be generated by any staff member.',

    'report_filters_description' => 'When generating this report, allow specifying the following filters:',
    'report_filter_user' => 'User Filter',
    'report_filter_userDescription' => 'Specify a system user by which to filter the datasets',
    'report_filter_date_label' => 'Date Filter',
    'report_filter_date_none' => 'No Date Filter',
    'report_filter_date_noneDescription' => 'Datasets will not be filtered by a date value',
    'report_filter_date_date' => 'Single Date',
    'report_filter_date_dateDescription' => 'Datasets can be filtered for a single date',
    'report_filter_date_date_range' => 'Date Range',
    'report_filter_date_date_rangeDescription' => 'Datasets can be filtered for values between 2 specified dates',

    'report_filter_hasFilters' => 'This report accepts the following runtime filter(s):',
    'report_filter_noFilters' => 'This report does not accept any runtime filters.',

    'teamAccessApproval' => 'Team Access Approval',
    'teamAccessApprovalDescription' => 'This Report will only be accessible by members of these teams.',
    'teamAccessApprovalShortDescription' => 'This Report is only accessible by members of these teams:',
    'unrestrictedDescription' => 'This Report is accessible by all of your staff.',


    'datasets' => 'Datasets',
    'dataset_name' => 'Name',
    'dataset_nameExamples' => 'Current Employees, Active Action Plans, etc...',
    'dataset_whatKindOfData' => 'What kind of data should this Dataset be composed of',
    'dataset_dataType' => 'Data Type',

    'dataset_pleaseSelectDataTypeForDataset' => 'Please select a data type for this Dataset',
    'dataset_pleaseSelectFileTypeForDataset' => 'Please select a FileType for this Dataset',
    'dataset_pleaseSelectFormDocForDataset' => 'Please select a FormDoc Template for this Dataset',

    'filter' => 'Filter',
    'filters' => 'Filters',
    'filter_filterField' => '',

    'filter_operator_equals' => 'Is Equal To',
    'filter_operator_not_equals' => 'Is Not Equal To',
    'filter_operator_greater_than' => 'Is Greater Than',
    'filter_operator_greater_than_equals' => 'Is Greater Than Or Equal To',
    'filter_operator_less_than' => 'Is Less Than',
    'filter_operator_less_than_equals' => 'Is Less Than Or Equal To',
    'filter_operator_between' => 'Is Between',
    'filter_operator_has_value' => 'Has A Value',
    'filter_operator_does_not_have_value' => 'Does Not Have A Value',

    'fields' => 'Fields',

];
