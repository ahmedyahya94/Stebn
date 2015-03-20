<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBikeStation extends Request {

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
		return [
			'functional' => 'required',
            'location'=> 'required',
            'max_capacity'=> 'required',
            'name'=> 'required',
            'batch_size'=> 'required',
		];
	}

}
