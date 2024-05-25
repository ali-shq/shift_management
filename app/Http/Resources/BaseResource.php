<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    protected function addTimeStamps (array &$array): void 
    {
        $array['created_at'] = $this->created_at->diffForHumans();
        $array['updated_at'] = $this->updated_at->diffForHumans();
    }

    protected function addCan(Request $request, array &$array, ?array $policies = null): void 
    {
        $policies = array_flip($policies ?? ['delete', 'update']);
        array_walk($policies, fn (&$val, $policy) => $val = $request->user()?->can($policy, $this->resource));
        $array['can'] = array_merge($array['can'] ?? [], $policies);
    }


    protected function addRelations(array &$array) 
    {
        foreach ($this->resource->relations as $relation) {
            $model = class_basename($relation);
            $resourceName = __NAMESPACE__.'\\'.$model.'Resource';
            $array[strtolower($model)] = $resourceName::make($this->whenLoaded(strtolower($model)));
        }
    }
    
}
