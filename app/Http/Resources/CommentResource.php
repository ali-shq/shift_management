<?php

namespace App\Http\Resources;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class CommentResource extends BaseResource
{
    private bool $withLikePermission = false;

    public function withLikePermission(): self
    {
        $this->withLikePermission = true;

        return $this;
    }

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
            'can' => [
                'like' => $this->when($this->withLikePermission, fn () => $request->user()?->can('create', [Like::class, $this->resource]))
            ],
        ];
        $this->addCan($request, $data);
        $this->addRelations($data);
        return $data;
    }
}
