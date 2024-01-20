<?php

namespace App\Repositories;

use App\Models\CarModel;
use App\Repositories\BaseRepository;

/**
 * Class CarModelRepository
 * @package App\Repositories
 * @version September 11, 2020, 6:50 am UTC
*/

class CarModelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'car_make_name',
        'name'
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
        return CarModel::class;
    }
}
