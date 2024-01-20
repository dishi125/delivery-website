<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class delivery_completion
 * @package App\Models
 * @version May 28, 2020, 10:58 am UTC
 *
 */
class delivery_completion extends Model
{
//    use SoftDeletes;

    public $table = 'delivery_completions';


//    protected $dates = ['deleted_at'];



    public $fillable = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
