<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Relation 1:1 of Profile with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
