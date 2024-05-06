<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class SkillResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
        $this->addTimeStamps($data);
        return $data;
    }
}
