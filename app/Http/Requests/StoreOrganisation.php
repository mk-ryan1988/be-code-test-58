<?php

namespace App\Http\Requests;

use App\Organisation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreOrganisation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Checking against passport auth
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('api')->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:Organisation|max:255'
        ];
    }
}
