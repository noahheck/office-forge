<?php

namespace App;

use App\FileStore\Drive;
use App\FileType\AccessLock;
use App\FileType\Form;
use App\FileType\Panel;
use App\FormDoc\Template;
use App\Interfaces\Datasetable;
use App\Report\Dataset\Filter;
use App\Report\Dataset\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileType extends Model implements Datasetable
{
    use SoftDeletes;

    const DATASET_FILTER_CREATED_DATE = 'created_date';
    const DATASET_FILTER_CREATED_BY = 'created_by';

    const DATASET_FIELD_CREATED_DATE = 'created_date';
    const DATASET_FIELD_CREATED_BY = 'created_by';

    const DEFAULT_ICON = 'fas fa-address-book';

    const ICON_OPTIONS = [
        'Addresses' => 'fas fa-address-book',
        'Archive' => 'fas fa-archive',
        'Asterisk' => 'fas fa-asterisk',
        'Scales' => 'fas fa-balance-scale',
        'Bed' => 'fas fa-bed',
        'Bell' => 'fas fa-bell',
        'Book' => 'fas fa-book',
        'Bread' => 'fas fa-bread-slice',
        'Briefcase' => 'fas fa-briefcase',
        'Medical' => 'fas fa-briefcase-medical',
        'Brush' => 'fas fa-brush',
        'Building' => 'fas fa-building',
        'Bus' => 'fas fa-bus',
        'Camera' => 'fas fa-camera',
        'Car' => 'fas fa-car',
        'Register' => 'fas fa-cash-register',
        'Cat' => 'fas fa-cat',
        'Child' => 'fas fa-child',
        'Clinic' => 'fas fa-clinic-medical',
        'Clipboard' => 'fas fa-clipboard',
        'Code' => 'fas fa-code',
        'Coffee' => 'fas fa-coffee',
        'Compass' => 'fas fa-drafting-compass',
        'Cube' => 'fas fa-cube',
        'Dog' => 'fas fa-dog',
        'Dolly' => 'fas fa-dolly',
        'Dumpster' => 'fas fa-dumpster',
        'Eye' => 'fas fa-eye',
        'Feather' => 'fas fa-feather-alt',
        'Female' => 'fas fa-female',
        'First Aid' => 'fas fa-first-aid',
        'Flag' => 'fas fa-flag',
        'Flask' => 'fas fa-flask',
        'Gas' => 'fas fa-gas-pump',
        'Gavel' => 'fas fa-gavel',
        'Glasses' => 'fas fa-glasses',
        'Globe' => 'fas fa-globe-americas',
        'Graduation' => 'fas fa-graduation-cap',
        'Grin' => 'far fa-grin',
        'Hamburger' => 'fas fa-hamburger',
        'Hammer' => 'fas fa-hammer',
        'Hard Hat' => 'fas fa-hard-hat',
        'Horse' => 'fas fa-horse',
        'Hospital' => 'fas fa-hospital',
        'Hotdog' => 'fas fa-hotdog',
        'Id Badge' => 'fas fa-id-badge',
        'Laptop' => 'fas fa-laptop',
        'Male' => 'fas fa-male',
        'Microphone' => 'fas fa-microphone',
        'Monument' => 'fas fa-monument',
        'Music' => 'fas fa-music',
        'Pizza' => 'fas fa-pizza-slice',
        'Road' => 'fas fa-road',
        'Rocket' => 'fas fa-rocket',
        'Screwdriver' => 'fas fa-screwdriver',
        'Sign' => 'fas fa-sign',
        'Skull' => 'fas fa-skull-crossbones',
        'Snowflake' => 'fas fa-snowflake',
        'Snowman' => 'fas fa-snowman',
        'Store' => 'fas fa-store',
        'Suitcase' => 'fas fa-suitcase',
        'Theater' => 'fas fa-theater-masks',
        'Thumbtack' => 'fas fa-thumbtack',
        'Toolbox' => 'fas fa-toolbox',
        'Tools' => 'fas fa-tools',
        'Tractor' => 'fas fa-tractor',
        'Trophy' => 'fas fa-trophy',
        'Truck' => 'fas fa-truck',
        'User' => 'fas fa-user',
        'Warehouse' => 'fas fa-warehouse',
        'Wrench' => 'fas fa-wrench',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'file_type_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'file_types_teams', 'file_type_id', 'team_id');
    }

    public function forms()
    {
        return $this->hasMany(Form::class)->orderBy('order');
    }

    public function panels()
    {
        return $this->hasMany(Panel::class, 'file_type_id')->orderBy('order');
    }

    public function processes()
    {
        return $this->hasMany(Process::class);
    }

    public function formDocTemplates()
    {
        return $this->hasMany(Template::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function accessLocks()
    {
        return $this->hasMany(AccessLock::class)->orderBy('name');
    }

    public function drives()
    {
        return $this->hasMany(Drive::class);
    }


    public function icon(array $withClasses = [])
    {
        $withClasses[] = $this->icon;

        $classes = e(implode(' ', $withClasses));

        $title = e($this->name);

        return "<span class='{$classes}' title='{$title}'></span>";
    }

    public function iconAndName($withClasses = [], bool $wrapped = true): string
    {
        $output = $this->icon($withClasses) . ' ' . e($this->name);

        if ($wrapped) {
            $output = "<span class='file-type-icon-and-name' data-id='" . $this->id . "'>" . $output . "</span>";
        }

        return $output;
    }

    public function instances()
    {
        return $this->files();
    }

    public function datasetableInstances()
    {
        return $this->instances();
    }

    public function instanceFieldValueRelationshipIdentifier()
    {
        return 'formFieldValues';
    }

    public function instanceFieldValueFieldIdentifier()
    {
        return 'file_type_form_field_id';
    }

    public function filterableFieldOptions()
    {
        $implicitFieldOptions = [
            Filter::makeFilterOption(self::DATASET_FILTER_CREATED_DATE, __('file.createdDate'), Filter::FILTER_OPTION_TYPE_DATE, []),
            Filter::makeFilterOption(self::DATASET_FILTER_CREATED_BY, __('file.createdBy'), Filter::FILTER_OPTION_TYPE_USER, []),
        ];

        $response = [
            $implicitFieldOptions,
        ];

        $this->loadMissing('forms', 'forms.fields');

        foreach ($this->forms as $form) {

            $formFields = [];

            foreach ($form->activeFields as $field) {

                if (!Filter::isValidFilterFieldType($field->field_type)) {
                    continue;
                }

                $formFields[] = Filter::makeFilterOption($field->id, $field->label, $field->field_type, $field->options);
            }

            if (count($formFields) > 0) {
                $response[$form->name] = $formFields;
            }
        }

        return $response;
    }

    public function reportableFieldOptions()
    {

        $implicitFieldOptions = [
            Field::makeFieldOption(self::DATASET_FIELD_CREATED_DATE, __('file.createdDate'), Field::FIELD_OPTION_TYPE_DATE, []),
            Field::makeFieldOption(self::DATASET_FIELD_CREATED_BY, __('file.createdBy'), Field::FIELD_OPTION_TYPE_USER, []),
        ];

        $response = [
            $implicitFieldOptions,
        ];

        $this->loadMissing('forms', 'forms.fields');

        foreach ($this->forms as $form) {

            $formFields = [];

            foreach ($form->activeFields as $field) {

                if (!Field::isValidReportableFieldType($field->field_type)) {
                    continue;
                }

                $formFields[] = Field::makeFieldOption($field->id, $field->label, $field->field_type, $field->options);
            }

            if (count($formFields) > 0) {
                $response[$form->name] = $formFields;
            }
        }

        return $response;
    }
}
