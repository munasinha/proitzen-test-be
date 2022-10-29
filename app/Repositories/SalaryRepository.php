<?php

namespace App\Repositories;

use App\Models\Salary;
use App\Repositories\Contracts\SalaryRepositoryInterface;

class SalaryRepository extends BaseEloquentRepository implements SalaryRepositoryInterface
{
    protected $model;

    public function __construct(Salary $model)
    {
        $this->model = $model;
    }


}
