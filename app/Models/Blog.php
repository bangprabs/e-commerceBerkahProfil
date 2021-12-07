<?php

namespace App\Models;

use App\Models\CategoryBlog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';

    public function categoryBlog()
    {
        return $this->belongsTo('App\Models\CategoryBlog', 'id');
    }
}
