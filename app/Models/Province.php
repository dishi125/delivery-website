<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Province
 * @package App\Models
 * @version September 25, 2020, 6:00 am UTC
 *
 * @property string $country_name
 * @property string $name
 */
class Province extends Model
{
    use SoftDeletes;

    public $table = 'provinces';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'country_name',
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
