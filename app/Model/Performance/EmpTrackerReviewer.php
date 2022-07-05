<?php

namespace App\Model\Performance;

use Illuminate\Database\Eloquent\Model;

class EmpTrackerReviewer extends Model
{
    protected $table = 'hr_performance_tracker_rev';
    public $timestamps = true;

    public function emp()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","emp_id");
    }

    public function tracker()
    {
      return $this->hasOne("App\Model\Performance\EmpTracker","id","tracker_id");
    }
}
