<?php

namespace App\Model\Performance;

use Illuminate\Database\Eloquent\Model;

class EmpTracker extends Model
{
    protected $table = 'hr_performance_tracker';
    public $timestamps = true;

    public function emp()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","emp_tracker");
    }
}
