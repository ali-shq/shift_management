<?php

namespace App\ShiftProblem;

use App\Models\BaseModel;

trait ModelAccessor
{
    protected BaseModel $model;

    public function __get($name)
    {
        if (property_exists($this->model, $name)) {
            return $this->model->name;
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this->model, $name)) {
            $this->model->name = $value;
        }
    }

    public function save(array $options = []): bool
    {
        return $this->model->save($options);
    }
}
