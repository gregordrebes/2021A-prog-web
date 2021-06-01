<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'title',
        'subtitle',
        'thumbnail',
        'body',
    ];

    public function users()
    {
        return $this->belongsTo("App\User");
    }

    public function categories()
    {
        return $this->belongsTo("App\Category");
    }
}
