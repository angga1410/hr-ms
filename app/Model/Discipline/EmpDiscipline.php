<?php

namespace App\Model\Discipline;

use Illuminate\Database\Eloquent\Model;

class EmpDiscipline extends Model
{
    protected $table = 'hr_pim_discipline';
    public $timestamps = true;

    public function emp()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","emp_id");
    }
    public function create_by()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","created_by");
    }
    public function act()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","acted_by");
    }
    public function action()
    {
      return $this->hasOne("App\Model\Discipline\DisciplineAction","id","action_id");
    }
}
