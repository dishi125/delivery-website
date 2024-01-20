<?php

namespace App\Repositories;

use App\Models\Temp_packages;
use App\Repositories\BaseRepository;

/**
 * Class Temp_packagesRepository
 * @package App\Repositories
 * @version June 11, 2020, 4:53 am UTC
*/

class Temp_packagesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'to_address_id',
        'weight',
        'packagekg',
        'dimensionl',
        'dimensionw',
        'dimensionh',
        'dimensions',
        'dvalue',
        'image',
        'date',
        'time'
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
        return Temp_packages::class;
    }
}
