<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{
    //
    public $table = 'permissions';

     protected $fillable = [
        'rol_id', 
        'page',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Models\rol');
    }

    public function users()
    {
        return $this->hasManyThrough(
            'App\User',
            'App\models\rol',
            'id',
            'rol_id'        
        );
    }

    

}
