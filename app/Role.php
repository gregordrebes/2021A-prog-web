<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    const MODERATOR = 1;
    const EDITOR = 2;

    public function users()
    {
        return $this->hasMany("App\User");
    }
}
