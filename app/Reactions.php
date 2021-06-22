<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reactions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'user_id',
        'post_id',
    ];
    
    public function users()
    {
        return $this->belongsTo("App\User");
    }

    public function posts()
    {
        return $this->belongsTo("App\Post");
    }
}
