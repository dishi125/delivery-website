<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class assign_driver
 * @package App\Models
 * @version May 25, 2020, 8:08 am UTC
 *
 */
class assign_driver extends Model
{

    public $table = 'assign_driver';

    public $fillable = [
        'driver_id',
        'from_user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'driver_id' => 'integer',
        'from_user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
//    public function getCountryAttribute()
//    {
//        return Country::where('id',$this->country_id)->pluck('name')->first();
//    }
    public function drivers()
    {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }

}
