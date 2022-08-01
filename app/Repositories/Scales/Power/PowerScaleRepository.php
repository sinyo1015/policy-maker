<?php

namespace App\Repositories\Scales\Power;

use App\Models\PowerScale;

class PowerScaleRepository implements PowerScaleRepositoryInterface
{
    private PowerScale $model;

    public function __construct(PowerScale $model)
    {
        $this->model = $model;
    }

    public function insert($data)
    {
        $this->model->insert($data);
    }

    public function create($data)
    {
        $this->model->create($data);
    }

    public function update($id, $data)
    {
        $this->model->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        $this->model->findOrFail($id)->delete();
    }

    public function detail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getAll()
    {
        return $this->model::all();
    }

    public function getWhereFirst($whereClause)
    {
        return $this->model->where($whereClause)->first();
    }

    public function getWhereMany($whereClause)
    {
        return $this->model->where($whereClause)->get();
    }

    public function getPaginated($length = 10, $page = 1)
    {
        return $this->model->paginate($length, ['*'], 'page', $page);
    }

    public function getPaginatedWithWhereClause( $whereClause, $length = 10, $page = 1)
    {
        return $this->model->where($whereClause)->paginate($length, ['*'], 'page', $page);
    }

    public function getEloquentInstance()
    {
        return $this->model;
    }
}