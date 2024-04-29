<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public function favorited_by_user()
    {   
        return $this->belongsTo(User::class, 'favorited_by_user_id');
    }
    public function recipe()
    {   
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
}
