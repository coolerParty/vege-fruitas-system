<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "blogs";

    public function category()
    {
        return $this->belongsTo(Category::Class,'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::Class,'user_id');
    }
}
