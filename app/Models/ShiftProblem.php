<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


//spots should be loaded with linked relations. This is the main model, and its associated controller the main controller
class ShiftProblem extends BaseModel
{
    use HasFactory;

    public function spots(): HasMany 
    {
        return $this->hasMany(Spot::class);
    }
}
