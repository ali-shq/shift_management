<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected const RESOURCE_NAMESPACE = 'App\Http\Resources';

    protected $addToGet = ['relations'];

    protected $searchFields = [];

    public function getSearchFields(): array 
    {
        return $this->searchFields;
    }

    public function getPlural(bool $lowerCase = false): string 
    {
        $plural = Str::plural(static::class);

        if ($lowerCase) {
            return Str::lower($plural);            
        }

        return $plural;
    }

    public function __get($key) 
    {
        $value = parent::__get($key);
        if (isset($value)) {
            return $value;
        }
        if (in_array($key, $this->addToGet)) {
            return $this->$key;
        }
    }

    public function showRoute(array $parameters = [])
    {
        return route($this->getPlural() . '.show', [$this, $this->name ? Str::slug($this->name) : $this->id, ...$parameters]);
    }

    public function getResourceName(): string 
    {
        $resourceName = static::RESOURCE_NAMESPACE . '\\' . class_basename($this->model);

        if (class_exists($resourceName)) {
            return $resourceName;
        }

        return static::RESOURCE_NAMESPACE . '\\BaseResource';
    }
}
