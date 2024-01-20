<?php

namespace App\Repositories;

use App\Models\delivery_completion;
use App\Repositories\BaseRepository;

/**
 * Class delivery_completionRepository
 * @package App\Repositories
 * @version May 28, 2020, 10:58 am UTC
*/

class delivery_completionRepository extends BaseRepository
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
        return delivery_completion::class;
    }
}
