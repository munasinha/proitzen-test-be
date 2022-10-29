<?php

namespace App\Models;

use App\Models\Title;
use App\Models\Salary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'emp_no';

    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['emp_no', 'first_name', 'last_name', 'gender', 'hire_date', 'birth_date'];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['hire_date', 'birth_date'];


    public function salaries()
    {
        return $this->hasMany(Salary::class, 'emp_no', 'emp_no');
    }

    public function titles()
    {
        return $this->hasMany(Title::class, 'emp_no', 'emp_no');
    }
}
