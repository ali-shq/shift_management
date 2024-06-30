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
                $created->$relation()->attach($this->prepareAttachData($relationData));
                continue;
            }

            foreach ($relationData as $row) {
                $created->$relation()->create($row);
            }
        }
        return $created;
    }

    public function update($attributes = [], $options = []): bool
    {
        $relationsDataByKey = $this->getRelationsData($data);
        
        $wasSaved = parent::update($attributes, $options);
        
        foreach ($relationsDataByKey as $relation => $relationData) {
            if (method_exists($this->$relation(), 'sync')) {
                $this->$relation()->sync($this->prepareAttachData($relationData));
                continue;
            }
            $this->updateRelationData($this->$relation(), $relationData);
        }
        return $wasSaved;
    }

    protected function updateRelationData(Relation $relation, array $newData) 
    {
        $oldData = $relation->get();

        $updatedIds = [];
        //make updates
        foreach ($newData as $ind => $row) {
            if (isset($row['id'])) {
                $oldRow = $oldData->find($row['id']);
                if ($oldRow) {
                    $oldRow->update($row);
                    $updatedIds[$row['id']] = true;
                    unset($newData[$ind]);
                }
            }
        }

        //make inserts
        $relation->insert(array_values($newData));

        //make deletes
        foreach ($oldData as $row) {
            if (!isset($updatedIds[$row['id']])) {
                $row->delete();
            }
        }
    }


    protected function prepareAttachData($data): array
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
