<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CarModel
 * @package App\Models
 * @version September 11, 2020, 6:50 am UTC
 *
 * @property string $car_make_name
 * @property string $name
 */
class CarModel extends Model
{
    use SoftDeletes;

    public $table = 'car_models';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'car_make_name',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'car_make_name' => 'string',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "car_make_name"=>"required",
        'name' => 'required|unique:car_models,name|regex:/^[A-Za-z _-]+$/'
    ];


}
