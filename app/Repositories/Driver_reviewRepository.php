<?php

namespace App\Repositories;

use App\Models\Driver_review;
use App\Repositories\BaseRepository;

/**
 * Class Driver_reviewRepository
 * @package App\Repositories
 * @version May 30, 2020, 6:05 am UTC
*/

class Driver_reviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'driver_id',
        'user_id',
        'rate',
        'comment'
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
        return Driver_review::class;
    }
}
