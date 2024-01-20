<?php

namespace App\Repositories;

use App\Models\pending_delivery;
use App\Repositories\BaseRepository;

/**
 * Class pending_deliveryRepository
 * @package App\Repositories
 * @version May 29, 2020, 9:51 am UTC
*/

class pending_deliveryRepository extends BaseRepository
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
        return pending_delivery::class;
    }
}
