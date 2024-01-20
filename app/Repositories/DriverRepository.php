<?php

namespace App\Repositories;

use App\Models\Driver;
use App\Repositories\BaseRepository;

/**
 * Class DriverRepository
 * @package App\Repositories
 * @version May 5, 2020, 12:01 pm UTC
*/

class DriverRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fname',
        'lname',
        'email',
        'mobile',
        'address',
        'car_make',
        'car_model',
        'car_image',
        'password'
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
        return Driver::class;
    }
}
