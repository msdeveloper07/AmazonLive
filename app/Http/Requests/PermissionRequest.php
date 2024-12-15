<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class PermissionRequest extends FormRequest
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
        return ['element' => 'required','component'=>'required','title'=>'required'];
        
			
        

        
	}
}
