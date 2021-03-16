<h1>Form Fields</h1>

<p>There are a variety of ways to collect information in Office Forge. The form systems in Office Forge are designed to help you and your staff collect the information you need to do your jobs efficiently. The type of field you choose to use for collecting a piece of information will depend on a variety of things, including the type of information, how it should be reported on, and the values you can expect to be input by your staff.</p>

<p>Here, we'll present the different types of form fields available within Office Forge. We'll present the use case for each field type along with the tradeoffs between selecting one field versus another.</p>

<hr>

<h3>Common Features</h3>

<p>Most Form Fields in Office Forge have some common features:</p>

<h5>Label</h5>

<p>The Label for a form field indicates what information should be recorded in that field. The form systems in Office Forge make a field's label <strong>bold</strong> to help orient the user to the field.</p>

<h5>Description</h5>

<p>A field's Description is additional information about the data point presented to your staff to help ensure they fill in the data correctly.</p>

<p>In the examples below, each field is output with the name of the field as the field's label and the supporting information displayed as the description. This will help show how a field will look when you configure it for your own forms.</p>

<hr />

<h3>Text Fields</h3>

<p>The following text fields accept unstructured text input from staff. These fields don't have any input requirements, so they are good choices for data that doesn't require validation.</p>

<div class="field-example">

@textField([
    'name' => 'text',
    'label' => 'Text Box',
    'details' => 'A single text box to capture information',
    'value' => '',
    'placeholder' => '',
    'inputGroupAppendText' => '',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

<hr>

@textareaField([
    'name' => 'textarea',
    'label' => 'Large Text Box',
    'details' => 'A multi-line text box to capture larger amounts of information',
    'value' => '',
    'placeholder' => '',
    'rows' => '3',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])
</div>



<h3>Specialized Text Fields</h3>

<p>These fields provide specialized handling of the data types they are intended to capture. You should use these types of fields whenever possible to help staff members input and validate the information they are entering.</p>

<div class="field-example">

@emailField([
    'name' => 'email',
    'label' => 'Email Address',
    'details' => "Use this field to capture email addresses; if the input value doesn't appear to be a valid email address, the user will be notified",
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

<hr>

@dateField([
    'name' => 'date',
    'label' => 'Date',
    'details' => 'Use this field for date values. A calendar will appear to help make selecting the correct date easy!',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

<hr>

@phoneField([
    'name' => 'phone',
    'label' => 'Phone Number',
    'details' => 'Use this field for phone numbers. The phone number will be formatted as the user enters it to help ensure accuracy!',
    'value' => '',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

</div>



<h3>Numeric Fields</h3>

<p>Office Forge offers a number of fields to capture numeric information. Using the appropriate field type for each data point in a form can help make sure the data collected is accurate and can help make reporting on that information much more pleasant.</p>

<div class="field-example">

@integerField([
    'name' => 'integer',
    'label' => 'Integer Field',
    'details' => 'Use this field for integer data points. Many browsers will include a widget for these fields to help make selecting the appropriate value easier.',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

<hr>

@decimalField([
    'name' => 'decimal',
    'label' => 'Decimal Field',
    'details' => 'Used to gather numeric values with a decimal point. The number of decimal points the field will accept and validate is configurable (up to 4 decimal points). This field has a configured value of 2 decimal points.',
    'value' => '',
    'decimalPlaces' => '2',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

<hr>

@moneyField([
    'name' => 'money',
    'label' => 'Monetary Field',
    'details' => 'Monetary fields are used to accept monetary values.',
    'value' => '',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

</div>



<h3>Specialized Field Types</h3>

<p>Office Forge also provides some enhanced specialized fields to help gather data easily and efficiently.</p>

<div class="field-example">

@rangeField([
    'name' => 'range',
    'label' => 'Range Field',
    'details' => 'Range Fields are great for collecting data along a scale. Range fields are highly configurable, with the low end of the scale beginning at 0 or 1, and the high end of the scale ranging from 3 to 10. The labels at each end of the scale are configurable as well.
    Use a range field to collect subjective data from staff, to map progress, and to show comparisons among a group.',
    'value' => '',
    'min' => '0',
    'max' => '10',
    'min_label' => 'Low',
    'max_label' => 'High',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

</div>

<div class="field-example">

@checkboxField([
    'name' => 'checkbox',
    'id' => 'checkbox',
    'label' => 'Checkbox Field',
    'details' => 'Checkbox fields are used to indicate a value as affirmative or negative. Use them to indicate state (e.g., Follow Up Required), or to indicate the presence/absence of a condition (e.g., Restricted Diet, Wears Glasses, or Requires Notification).',
    'checked' => false,
    'value' => '',
    'required' => false,
    'error' => false,
    'readonly' => false,
])

</div>

<div class="field-example">

@selectField([
    'name' => 'select',
    'id' => 'select',
    'label' => 'Select Box',
    'details' => 'Select Boxes allow you to specify a set of options from which staff members will choose. These fields are comfortable for staff members to fill out and present wonderful reporting options as well. Use them when there are a known set of possible values from which to choose for a field.',
    'value' => '',
    'options' => [
        '1' => 'Option 1',
        '2' => 'Option 2',
        '3' => 'Option 3',
    ],
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

</div>



<h3>Combination Fields</h3>

<p>Office Forge also comes with some pre-configured combination field types to help make gathering and using data more straightforward!</p>

<div class="field-example">

@php
    $nameField = new \App\FormDoc\Template\Field;
    $nameField->label = 'Name Field';
    $nameField->description = "The Name Field is used to collect a person's name, including First, Middle, and Last name, and a possible suffix.";
@endphp

@include('_form_field.name', [
    'field' => $nameField,
    'value' => optional((object) []),
    'readonly' => false,
])

</div>

<div class="field-example">

@php
    $addressField = new \App\FormDoc\Template\Field;
    $addressField->label = 'Address Field';
    $addressField->description = "Use the Address Field to collect all of the details for a US address.";
@endphp

@include('_form_field.address', [
    'field' => $addressField,
    'value' => optional((object) []),
    'readonly' => false,
])

</div>



<h3>Entity Fields</h3>

<p>Office Forge also presents unique fields for referencing other Entities within Office Forge. These specialized fields allow you to organize your information in ways that truly match the way you work.</p>

<div class="field-example">

@userSelectField([
    'name' => 'user',
    'label' => 'User Field',
    'value' => '',
    'users' => collect([Auth::user()]),
    'placeholder' => 'Select a user',
    'description' => "The User Field allows staff to select an Office Forge user for a field's value. The options that appear in the list can be filtered by Team to ensure only appropriate user's can be selected for an individual field.",
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

</div>

<div class="field-example">

@fileSearchField([
    'name' => 'file',
    'label' => 'File Field',
    'value' => '',
    'fileType' => '',
    'placeholder' => 'Select a file',
    'description' => "The File Field allows staff to select one of the Files that has been entered into your Office Forge system. The options that appear in the list can be filtered to a specific File Type to help ensure only an appropriate File resource can be selected for an individual field.",
    'required' => false,
    'autofocus' => false,
    'error' => false,
    'readonly' => false,
    'fieldOnly' => false,
])

</div>



<h3>Additional Fields</h3>

<div class="field-example" style="padding-top: 0;">

@include('_form_field.section-header', [
    'field' => (object) [
        'label' => 'Section Header',
        'description' => "Section headers are specialized field types that can be added to a form to help organize the form's fields. Use them to group fields into organizational concerns, by process, or to provide additional information to staff on how to successfully complete a form.",
    ],
])

</div>
