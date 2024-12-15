<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGroupRequest extends FormRequest
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
        return array('user_group_name' => 'required');
        
			
        

        
	}
}
