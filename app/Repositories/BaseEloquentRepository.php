<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Repositories\Contracts\BaseEloquentRepositoryInterface;

class BaseEloquentRepository implements BaseEloquentRepositoryInterface
{
    protected $model;

    /**
     * Find the model given an id
     * @param int $id
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Find the model given an id
     * @param int $id
     */
    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find all models
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * find All With Paginate
     * @return Collection
     */
    public function findAllWithPaginate($paginate=15)
    {
        return $this->model->paginate($paginate);
    }


    /**
     * Find by given ids and relative column name
     * @param array $ids
     * @param string $column
     * @return Collection
     */
    public function findIn(array $ids, string $column = 'id'): Collection
    {
        return $this->model->whereIn($column, $ids)->get();
    }

    /**
     * Update record with the given id and data
     * @param int $id
     * @param array $data
     */
    public function updateWithId(int $id, array $data)
    {
        $model = $this->model->findOrFail($id);
        return $this->update($model, $data);
    }

    /**
     * Update record with the given model and data
     * @param $model
     * @param array $data
     */
    public function update($model, array $data)
    {
        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }

        $model->save();

        return $model;
    }

    /**
     * Create
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Delete by id
     * @param int $id
     */
    public function deleteById(int $id)
    {
        $model = $this->model->findOrFail($id);

        return $model->delete();
    }

}
