<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'message'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}