<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Driver
 * @package App\Models
 * @version May 5, 2020, 12:01 pm UTC
 *
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $mobile
 * @property string $address
 * @property string $car_make
 * @property string $car_model
 * @property string $car_image
 * @property string $password
 */
class Driver extends Model
{
    public $table = 'drivers';

        public $fillable = [
        'fname',
        'lname',
        'email',
        'mobile',
        'address',
        'car_make',
        'car_model',
        'year',
        'car_image',
        'password',
        'profile_pic',
        'regno',
        'insuranceno',
            'insuranc_image',
            'licenceno',
            'licence_image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fname' => 'string',
        'lname' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'address' => 'string',
        'car_make' => 'string',
        'car_model' => 'string',
        'year' => 'string',
        'car_image' => 'string',
        'password' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required',
        'mobile' => 'required',
        'address' => 'required',
        'car_make' => 'required',
        'password' => 'required'
    ];
    public function getProfileAttribute()
    {
        return  url('public/images/profile/'.$this->profile_pic);
    }
    public function getCarimgAttribute()
    {
        return  url('public/images/car_images/'.$this->car_image);
    }
    public function getInsuranceimgAttribute()
    {
        return  url('public/images/insurance_images/'.$this->insuranc_image);
    }
    public function getLicenceimgAttribute()
    {
        return  url('public/images/licence_images/'.$this->licence_image);
    }


}
