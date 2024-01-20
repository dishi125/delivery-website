<?php

namespace App\Repositories;

use App\Models\Web_User;
use App\Repositories\BaseRepository;

/**
 * Class Web_UserRepository
 * @package App\Repositories
 * @version May 5, 2020, 11:42 am UTC
*/

class Web_UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fname',
        'lname',
        'email',
        'mobile'
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
        return Web_User::class;
    }
}
