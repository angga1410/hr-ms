<?php

namespace App\Model\Training;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'hr_session';
    public $timestamps = true;

    public function course()
    {
      return $this->hasOne("App\Model\Training\Course","id","course_id");
    }
}
