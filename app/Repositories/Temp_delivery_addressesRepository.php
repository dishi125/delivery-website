<?php

namespace App\Repositories;

use App\Models\Temp_delivery_addresses;
use App\Repositories\BaseRepository;

/**
 * Class Temp_delivery_addressesRepository
 * @package App\Repositories
 * @version June 11, 2020, 4:44 am UTC
*/

class Temp_delivery_addressesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'user_id',
        'to_form',
        'name',
        'company_id',
        'country_id',
        'street_add',
        'street_add1',
        'mobile',
        'mobile1',
        'email',
        'sms_verification',
        'price'
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
        return Temp_delivery_addresses::class;
    }
}
