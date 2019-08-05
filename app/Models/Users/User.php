<?php

namespace App\User;

use Eloquent as Model;

/**
 * Class User
 * @package App\Models\15
 * @version July 8, 2019, 7:12 pm UTC
 *
 * @property string name
 * @property string email
 * @property string password
 * @property boolean is_active
 * @property string image
 * @property integer enterprise_id
 */
class User extends Model
{

    public $table = 'users';
    


    public $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'image',
        'enterprise_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'is_active' => 'boolean',
        'image' => 'string',
        'enterprise_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
