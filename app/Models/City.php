<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 * @package App\Models
 * @version September 25, 2020, 6:25 am UTC
 *
 * @property string $country_name
 * @property string $city
 */
class City extends Model
{
    use SoftDeletes;

    public $table = 'cities';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'country_name',
        'province_name',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'country_name' => 'string',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'country_name' => 'required',
        'name' => 'required'
    ];


}
