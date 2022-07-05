<?php

namespace App\Model\Recruitment;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'hr_vacancies_candidate';
    public $timestamps = true;

  
    public function vacancy()
    {
      return $this->hasOne("App\Model\Recruitment\Vacancy","id","vacancy_id");
    }

}
