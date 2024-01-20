<?php

namespace App\Repositories;

use App\Models\assign_driver;
use App\Repositories\BaseRepository;

/**
 * Class assign_driverRepository
 * @package App\Repositories
 * @version May 25, 2020, 8:08 am UTC
*/

class assign_driverRepository extends BaseRepository
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
        return assign_driver::class;
    }
}
