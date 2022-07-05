<?php

namespace App\Model\Recruitment;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'hr_vancacies_job';
    public $timestamps = true;

    public function job_title()
    {
      return $this->hasOne("App\Model\Admin\JobTitle","id","job_title_id");
    }
    public function departement()
    {
      return $this->hasOne("App\Model\Admin\JobCategory","id","sub_unit_id");
    }
    public function emp()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","hiring_manager");
    }
    public function location()
    {
      return $this->hasOne("App\Model\Admin\Location","id","location_id");
    }

}
