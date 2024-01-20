<?php

namespace App\Repositories;

use App\Models\Province;
use App\Repositories\BaseRepository;

/**
 * Class ProvinceRepository
 * @package App\Repositories
 * @version September 25, 2020, 6:00 am UTC
*/

class ProvinceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'country_name',
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
        return Province::class;
    }
}
