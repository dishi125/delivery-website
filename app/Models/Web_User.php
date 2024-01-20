<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Web_User
 * @package App\Models
 * @version May 5, 2020, 11:42 am UTC
 *
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $mobile
 */
class Web_User extends Model
{
    public $table = 'web_users';

    public $fillable = [
        'fname',
        'lname',
        'email',
        'mobile',
        'address',
        'password',
        'profile_pic',

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
        'address' => 'text',
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
        'mobile' => 'required'
    ];

    public function getProfileAttribute()
    {
        return  url('public/images/profile/'.$this->profile_pic);
    }
    public function addresses()
    {
        return $this->hasMany(Delivery_Addresses::class,"user_id","id");
    }


}
