<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\CarMake;

class UpdateCarMakeRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules =  [
            "car_make_name"=>"required",
            'name' => 'required|regex:/^[A-Za-z _-]+$/|unique:car_makes,name,'.\Illuminate\Http\Request::segment(2)
        ];

        $rules['name'] = $rules['name'].",".$this->route("car_make");
        return $rules;
    }
}
