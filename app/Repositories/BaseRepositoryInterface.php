<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function insert($data);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function detail($id);
    public function getAll();
    public function getWhereFirst($whereClause);
    public function getWhereMany($whereClause);
    public function getPaginated($length = 10, $page = 1);
    public function getPaginatedWithWhereClause($whereClause, $length = 10, $page = 1);
    public function getEloquentInstance();
}