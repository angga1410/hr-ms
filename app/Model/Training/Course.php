<?php

namespace App\Model\Training;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'hr_course';
    public $timestamps = true;

    public function emp()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","coordinator_emp");
    }
    public function dept()
    {
      return $this->hasOne("App\Model\Admin\JobCategory","id","dept_id");
    }
}
