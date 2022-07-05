<?php

namespace App\Model\Expense;

use Illuminate\Database\Eloquent\Model;

class ExpenseConfig extends Model
{
    protected $table = 'con_expense_type';
    public $timestamps = true;
}
