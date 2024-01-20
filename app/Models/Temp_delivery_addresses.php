<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Temp_delivery_addresses
 * @package App\Models
 * @version June 11, 2020, 4:44 am UTC
 *
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $to_form
 * @property string $name
 * @property integer $company_id
 * @property integer $country_id
 * @property string $street_add
 * @property string $street_add1
 * @property string $mobile
 * @property string $mobile1
 * @property string $email
 * @property string $sms_verification
 * @property integer $price
 */
class Temp_delivery_addresses extends Model
{
    public $table = 'temp_delivery_addresses';

    public $fillable = [
        'parent_id',
        'user_id',
        'to_form',
        'name',
        'company_id',
        'country_id',
        'street_add',
        'lat',
        'long',
        'street_add1',
        'mobile',
        'mobile1',
        'email',
        'sms_verification',
        'price',
        'planname',
        'is_sent_req',
        'province',
        'city',
        'postalcode'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'user_id' => 'integer',
        'to_form' => 'string',
        'name' => 'string',
        'company_id' => 'string',
        'country_id' => 'integer',
        'street_add' => 'string',
        'street_add1' => 'string',
        'mobile' => 'string',
        'mobile1' => 'string',
        'email' => 'string',
        'sms_verification' => 'string',
        'price' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getPackage(){
        return $this->hasMany(Temp_packages::class,'to_address_id','id');
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($temp) {
            $temp->getPackage()->delete();
        });
    }

    public function getCountryAttribute()
    {
        return Country::where('id',$this->country_id)->pluck('name')->first();
    }

}
