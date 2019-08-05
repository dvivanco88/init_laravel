<?php

namespace App\Models\Enterprises;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Enterprise",
 *      required={""},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tel",
 *          description="tel",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ext_tel",
 *          description="ext_tel",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="contact_name",
 *          description="contact_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email_contact",
 *          description="email_contact",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="rfc",
 *          description="rfc",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="adress",
 *          description="adress",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_active",
 *          description="is_active",
 *          type="boolean"
 *      )
 * )
 */
class Enterprise extends Model
{
    use SoftDeletes;

    public $table = 'enterprises';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'tel',
        'ext_tel',
        'contact_name',
        'email_contact',
        'image',
        'rfc',
        'adress',
        'is_active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'tel' => 'string',
        'ext_tel' => 'string',
        'contact_name' => 'string',
        'email_contact' => 'string',
        'image' => 'string',
        'rfc' => 'string',
        'adress' => 'string',
        'is_active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

     public function users()
    {
        return $this->hasMany('App\User');
    }

    
}
