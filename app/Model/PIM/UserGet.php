<?php

namespace App\Model\PIM;

use Illuminate\Database\Eloquent\Model;

class UserGet extends Model
{
    protected $table = 'users';
    public $timestamps = true;

    public function emp()
    {
      return $this->hasOne("App\Model\PIM\Employee","id","emp_id");
    }
}
