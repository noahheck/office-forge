<?php

namespace App;

use App\FileType\Form;
use App\FileType\FormDoc;
use App\FileType\Panel;
use App\Traits\Authorization\GrantsAccessByTeamMembership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileType extends Model
{
    use SoftDeletes,
        GrantsAccessByTeamMembership;

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

    public function formDocs()
    {
        return $this->hasMany(FormDoc::class);
    }


    public function icon(array $withClasses = [])
    {
        $withClasses[] = $this->icon;

        $classes = e(implode(' ', $withClasses));

        $title = e($this->name);

        return "<span class='{$classes}' title='{$title}'></span>";
    }
}
