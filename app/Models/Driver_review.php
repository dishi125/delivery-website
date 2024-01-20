<?php

namespace App\Models;

use App\Helpers\CommonHelper;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Driver_review
 * @package App\Models
 * @version May 30, 2020, 6:05 am UTC
 *
 * @property integer $driver_id
 * @property integer $user_id
 * @property integer $rate
 * @property string $comment
 */
class Driver_review extends Model
{
    public $table = 'driver_review';

    public $fillable = [
        'driver_id',
        'user_id',
        'rate',
        'comment'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'driver_id' => 'integer',
        'user_id' => 'integer',
        'rate' => 'integer',
        'comment' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getFdriverAttribute()
    {
        return Driver::where('id',$this->driver_id)->pluck('fname')->first();
    }
    public function getLdriverAttribute()
    {
        return Driver::where('id',$this->driver_id)->pluck('lname')->first();
    }
    public function getUserAttribute()
    {
        return Web_User::where('id',$this->user_id)->pluck('fname')->first();
    }
    public function getLUserAttribute()
    {
        return Web_User::where('id',$this->user_id)->pluck('lname')->first();
    }

    public function getCreatedAtAttribute()
    {
    return CommonHelper::UTCToLocalDateTime($this->attributes['created_at'], 'Canada/Atlantic')->format('Y-m-d \a\\t h.ia');
    }
}
