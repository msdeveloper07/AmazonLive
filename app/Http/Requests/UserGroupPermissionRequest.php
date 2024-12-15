<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class UserGroupPermissionRequest extends FormRequest
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
        return ['user_group_id' => 'required'];
        
			
        

        
	}
}
