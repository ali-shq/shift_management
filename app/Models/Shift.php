<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shift extends BaseModel
{
    use HasFactory;

    protected $searchFields = ['label', 'starts_at', 'ends_at'];


    public function places(): BelongsToMany 
    {
        return $this->belongsToMany(Place::class);
    }
}
