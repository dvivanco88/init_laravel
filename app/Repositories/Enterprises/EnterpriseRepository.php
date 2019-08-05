<?php

namespace App\Repositories\Enterprises;

use App\Models\Enterprises\Enterprise;
use App\Repositories\BaseRepository;

/**
 * Class EnterpriseRepository
 * @package App\Repositories\Enterprises
 * @version July 8, 2019, 1:36 am UTC
*/

class EnterpriseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Enterprise::class;
    }
}
