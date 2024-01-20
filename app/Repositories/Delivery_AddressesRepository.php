<?php

namespace App\Repositories;

use App\Models\Delivery_Addresses;
use App\Repositories\BaseRepository;

/**
 * Class Delivery_AddressesRepository
 * @package App\Repositories
 * @version May 20, 2020, 10:34 am UTC
*/

class Delivery_AddressesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return Delivery_Addresses::class;
    }
}
