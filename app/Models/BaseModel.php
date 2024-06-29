<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        $plural = Str::plural(class_basename(static::class));

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
        return route($this->getPlural(true) . '.show', [$this->id, $this->name ? Str::slug($this->name) : $this->id, ...$parameters]);
    }

    public function getResourceName(): string 
    {
        $resourceName = static::RESOURCE_NAMESPACE . '\\' . class_basename(static::class) . 'Resource';
        if (class_exists($resourceName)) {
            return $resourceName;
        }

        return static::RESOURCE_NAMESPACE . '\\BaseResource';
    }

    public function create($data): static
    {
        $relationsDataByKey = $this->getRelationsData($data);
        $created = parent::create($data);

        foreach ($relationsDataByKey as $relation => $relationData) {
            if (method_exists($created->$relation(), 'attach')) {
                $created->$relation()->attach($this->prepareAttachData($relationData, $created->$relation()));
                continue;
            }

            foreach ($relationData as $row) {
                $created->$relation()->create($row);
            }
        }

        //TODO load the relations data or get them from above

        return $created;
    }

    //TODO add update case

    protected function prepareAttachData($data, Relation $relation): array
    {
        $attachData = [];
        foreach ($data as $row) {
            $id = $row['id'];
            unset($row['id']);
            $attachData[$id] = $row;
        }
        return $attachData;
    }

    protected function getRelationsData(&$data) 
    {
        $relationsDataByKey = [];

        foreach ($data as $key => $value) {
            if ($this->isRelation($key)) {
                $relationsDataByKey[$key] = $value;
                unset($data[$key]);
            }
        }
        return $relationsDataByKey;
    }
}
