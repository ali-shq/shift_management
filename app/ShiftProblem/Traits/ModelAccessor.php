<?php

namespace App\ShiftProblem;

use App\Models\BaseModel;
use BadMethodCallException;

trait ModelAccessor
{
    protected BaseModel $model;

    public function _new(BaseModel $model): self
    {
        $this->model = $model;
        return $this;
    }

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

    public function __call($name, $arguments)
    {
        if (method_exists($this->model, $name)) {
            return $this->model->$name(...$arguments);
        }

        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $name
        ));
    }
}
