<?php

namespace App\Model\PIM;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'hr_pim_employee';
    public $timestamps = true;

    public function job()
    {
      return $this->hasOne("App\Model\Admin\JobTitle","id","emp_job_title");
    }
    public function departement()
    {
      return $this->hasOne("App\Model\Admin\JobCategory","id","emp_job_ctg");
    }
    public function empstatus()
    {
      return $this->hasOne("App\Model\PIM\EmployeeStatus","id","emp_status");
    }
    public function supervisor()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","emp_supervisor_id");
    }
    public function location()
    {
      return $this->hasOne("App\Model\Admin\Location","id","emp_location");
    }
    public function contact()
    {
        return $this->hasMany('App\Model\PIM\EmployeeContact','emp_id');
    }
 
 
}
