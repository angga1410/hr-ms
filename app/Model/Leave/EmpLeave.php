<?php

namespace App\Model\Leave;

use Illuminate\Database\Eloquent\Model;

class EmpLeave extends Model
{
    protected $table = 'hr_leave';
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
