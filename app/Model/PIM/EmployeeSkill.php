<?php

namespace App\Model\PIM;

use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    protected $table = 'hr_pim_emp_skill';
    public $timestamps = true;

    public function skills()
    {
      return $this->hasOne("App\Model\Admin\SKill","id","skill");
    }
}
