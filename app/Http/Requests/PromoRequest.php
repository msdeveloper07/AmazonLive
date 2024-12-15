<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class PromoRequest extends FormRequest
{
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
        return ['promo_name' => 'required', 'sales_price' => 'required', 'normal_price' => 'required', 'aisn' => 'required',];
        
			
        

        
	}
}
