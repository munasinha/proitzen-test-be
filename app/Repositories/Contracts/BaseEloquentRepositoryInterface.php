<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface BaseEloquentRepositoryInterface
{
    public function find(int $id);

    public function findOrFail(int $id);

    public function findAll(): Collection;

    public function findAllWithPaginate($paginate=15);

    public function updateWithId(int $id, array $data);

    public function update($model, array $data);

    public function create(array $data);

    public function deleteById(int $id);


}
