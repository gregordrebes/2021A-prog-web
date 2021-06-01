<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'color',
        'icon'
    ];
    
    public function post()
    {
        return $this->hasMany("App\Post");
    }
}
