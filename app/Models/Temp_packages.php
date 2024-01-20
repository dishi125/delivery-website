<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Temp_packages
 * @package App\Models
 * @version June 11, 2020, 4:53 am UTC
 *
 * @property integer $to_address_id
 * @property integer $weight
 * @property string $packagekg
 * @property integer $dimensionl
 * @property integer $dimensionw
 * @property integer $dimensionh
 * @property string $dimensions
 * @property integer $dvalue
 * @property string $image
 * @property string $date
 * @property time $time
 */
class Temp_packages extends Model
{
    public $table = 'temp_package';

    public $fillable = [
        'to_address_id',
        'location',
        'place',
        'packagecnt',
        'weight',
        'packagekg',
        'dimesionl',
        'dimesionw',
        'dimesionh',
        'dimesions',
        'dvalue',
        'image',
        'date',
        'time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'to_address_id' => 'integer',
        'weight' => 'integer',
        'packagekg' => 'string',
        'dimensionl' => 'integer',
        'dimensionw' => 'integer',
        'dimensionh' => 'integer',
        'dimensions' => 'string',
        'dvalue' => 'integer',
        'image' => 'string',
        'date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getPathAttribute()
    {
        return  url('public/images/packageimg/'.$this->image);
    }

}
