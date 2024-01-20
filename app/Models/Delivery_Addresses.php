<?php

namespace App\Models;

use App\Helpers\CommonHelper;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Delivery_Addresses
 * @package App\Models
 * @version May 20, 2020, 10:34 am UTC
 *
 */
class Delivery_Addresses extends Model
{
//    use SoftDeletes;

    public $table = 'delivery_addresses';


//    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'to_form',
        'parent_id',
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
        'user_id'=>'integer',
        'to_form' => 'string',
        'name'=>'string',
        'company_id'=>'string',
        'country_id'=>'integer',
        'street_add'=>'string',
        'mobile'=>'string',
        'mobile1'=>'string',
        'email'=>'string',
        'sms_verification'=>'string'
    ];
    public function getCountryAttribute()
    {
        return Country::where('id',$this->country_id)->pluck('name')->first();
    }
    public function getFirstNameAttribute()
    {
        return Web_User::where('id',$this->user_id)->pluck('fname')->first();
    }
    public function getLastNameAttribute()
    {
        return Web_User::where('id',$this->user_id)->pluck('lname')->first();
    }

    public function getPackage(){
        return $this->hasMany(Package_Detail::class,'to_address_id','id');
    }

    public function company()
    {
        return $this->hasOne(Company::class,"id","company_id");
    }

    public function getDeliverycompicAttribute(){
        return url('public/images/complete_photo/'.$this->delivery_cmppic);
    }
    /*public function country()
    {
        return $this->hasOne(Country::class,"id","country_id");
    }*/
    public function users()
    {
        return $this->belongsTo(Web_User::class,'user_id','id');
    }
    public function assigndrivers()
    {
        return $this->belongsTo(assign_driver::class,'id','from_user_id');
    }

    public function getUpdatedAtAttribute()
    {
        return CommonHelper::UTCToLocalDateTime($this->attributes['updated_at'], 'Canada/Atlantic')->format('Y-m-d \a\\t h.ia');
    }
}
