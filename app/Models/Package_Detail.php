<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package_Detail extends Model
{
    public $table = 'packages';
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
        'dimensions',
        'dvalue',
        'image',
        'date',
        'time'
    ];
    public function getPackageImageAttribute()
    {
        return  url('public/images/packageimg/'.$this->image);
    }


    public function getPathAttribute()
    {
        return url('public/images/packageimg/'.$this->image);
    }

}
