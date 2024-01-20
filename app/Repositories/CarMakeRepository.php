<?php

namespace App\Repositories;

use App\Models\CarMake;
use App\Repositories\BaseRepository;

/**
 * Class CarMakeRepository
 * @package App\Repositories
 * @version September 10, 2020, 9:17 am UTC
*/

class CarMakeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return CarMake::class;
    }
}
