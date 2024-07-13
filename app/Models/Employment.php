<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Employment extends BaseModel
{
    use HasFactory;

    public function scopeActive(Builder $q, $startDate, $endDate): void 
    {
        $q->where('start_date', '<=', $endDate)->orWhere(fn(Builder $q) => $q->where('end_date', null)->where('end_date', '>=', $startDate));
    }
}
