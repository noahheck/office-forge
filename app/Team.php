<?php

namespace App;

use App\FileType\Form;
use App\FileType\Panel;
use App\FormDoc\Template;
use App\Traits\GetsInitialsFromName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes,
        GetsInitialsFromName;


    public function members()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function icon()
    {
        return "<span class='team-icon' style='background-color: {$this->color};' title='" . e($this->name) . "'>{$this->initials}</span>";
    }


    public function creatableProcesses()
    {
        return $this->belongsToMany(Process::class, 'processes_teams_creators');
    }

    public function fileTypes()
    {
        return $this->belongsToMany(FileType::class, 'file_types_teams', 'team_id', 'file_type_id')->withTimestamps();
    }

    public function fileTypeForms()
    {
        return $this->belongsToMany(Form::class, 'file_type_forms_teams', 'team_id' , 'file_type_form_id')->withTimestamps();
    }

    public function fileTypePanels()
    {
        return $this->belongsToMany(Panel::class, 'file_type_panels_teams', 'team_id', 'file_type_panel_id')->withTimestamps();
    }

    public function formDocTemplates()
    {
        return $this->belongsToMany(Template::class, 'form_doc_templates_teams', 'team_id', 'form_doc_template_id')->withTimestamps();
    }
}
