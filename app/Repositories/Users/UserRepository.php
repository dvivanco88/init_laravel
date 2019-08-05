<?php

namespace App\Repositories\Users;

use App\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\15
 * @version July 8, 2019, 7:12 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'is_active',
        'image',
        'enterprise_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
