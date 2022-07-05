<?php

namespace App\Model\Performance;

use Illuminate\Database\Eloquent\Model;

class EmpTrackerLog extends Model
{
    protected $table = 'hr_performance_tracker_log';
    public $timestamps = true;

    public function emp()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","emp_tracker");
    }

    public function tracker()
    {
      return $this->hasOne("App\Model\Performance\EmpTracker","id","tracker_id");
    }
}
