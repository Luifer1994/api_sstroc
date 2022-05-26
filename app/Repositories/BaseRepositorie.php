<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepositorie
{
    protected $model;
    protected $relationships;

    function __construct(Model $model, array $relationships = [])
    {
        $this->model = $model;
        $this->relationships = $relationships;
    }

    public function save(Model $model)
    {
        $model->save();
        return $model;
    }

    public function show(int $id)
    {
        $query = $this->model;
        if (!empty($this->relationships)) {
            $query =   $query->with($this->relationships);
        }
        return $query->find($id);
    }
}
