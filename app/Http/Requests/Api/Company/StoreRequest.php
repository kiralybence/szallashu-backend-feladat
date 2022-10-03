<?php

namespace App\Http\Requests\Api\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'companyName' => ['required', 'max:255'],
            'companyRegistrationNumber' => ['required', 'max:255'],
            'companyFoundationDate' => ['required', 'date:Y-m-d'],
            'country' => ['required', 'max:255'],
            'zipCode' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'streetAddress' => ['required', 'max:255'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'companyOwner' => ['required', 'max:255'],
            'employees' => ['required', 'max:255'],
            'activity' => ['required', 'max:255'],
            'active' => ['required', 'boolean'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:255'],
        ];
    }
}
