<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Number;

class CommentResource extends BaseResource
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
            'body' => $this->body,
            'html' => $this->html,
            'likes_count' => Number::abbreviate($this->likes_count),
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
        $this->addCan($request, $data);
        $this->addRelations($data);
        return $data;
    }
}
