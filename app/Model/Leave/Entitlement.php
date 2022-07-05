<?php

namespace App\Model\Leave;

use Illuminate\Database\Eloquent\Model;

class Entitlement extends Model
{
    protected $table = 'hr_emp_entl';
    public $timestamps = true;
    public function type()
    {
      return $this->hasOne("App\Model\Leave\LeaveType","id","leave_type");
    }
    public function emp()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","emp_id");
    }
}
