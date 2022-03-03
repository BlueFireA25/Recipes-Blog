<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'ingredients',
        'preparation',
        'image',
        'category_id',
    ];

    // Get recipe category via FK
    public function category()
    {
        return $this->belongsTo(CategoryRecipe::class);
    }

    //Get user information via FK
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); // FK in this table
    }

    // Likes that a recipe has received
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_recipe');
    }
}
