<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CarMake
 * @package App\Models
 * @version September 10, 2020, 9:17 am UTC
 *
 * @property string $name
 */
class CarMake extends Model
{
    use SoftDeletes;

    public $table = 'car_makes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:car_makes,name|regex:/^[A-Za-z _-]+$/'
    ];


}
