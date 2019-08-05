<?php

namespace App\Repositories;

use App\Models\rol;
use App\Repositories\BaseRepository;

/**
 * Class rolRepository
 * @package App\Repositories
 * @version July 11, 2019, 11:42 am CDT
*/

class rolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'is_active'
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
        return rol::class;
    }
}
