<?php

namespace App\Repositories;

use App\Models\Title;
use App\Repositories\Contracts\TitleRepositoryInterface;

class TitleRepository extends BaseEloquentRepository implements TitleRepositoryInterface
{
    protected $model;

    public function __construct(Title $model)
    {
        $this->model = $model;
    }


}
