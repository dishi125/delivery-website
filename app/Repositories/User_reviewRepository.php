<?php

namespace App\Repositories;

use App\Models\User_review;
use App\Repositories\BaseRepository;

/**
 * Class User_reviewRepository
 * @package App\Repositories
 * @version May 30, 2020, 7:41 am UTC
*/

class User_reviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'driver_id',
        'user_id',
        'to_user_id',
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
        return User_review::class;
    }
}
