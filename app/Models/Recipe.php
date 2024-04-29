<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function user()
    {   
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        // 2nd argument is the foreign key (of the answers table)
        // 3rd argument is the local key (primary key of the questions table)
        return $this->hasMany(Recipe::class, 'recipe_id', 'id');
    }
}
