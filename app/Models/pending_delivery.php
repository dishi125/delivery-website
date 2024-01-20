<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class pending_delivery
 * @package App\Models
 * @version May 29, 2020, 9:51 am UTC
 *
 */
class pending_delivery extends Model
{
//    use SoftDeletes;

    public $table = 'pending_deliveries';


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
