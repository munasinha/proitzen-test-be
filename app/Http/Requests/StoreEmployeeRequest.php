<?php

namespace App\Http\Requests;

use App\Enum\GenderEnums;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'    => 'required|string|max:14',
            'last_name'     => 'required|string|max:16',
            'gender'        => [new Enum(GenderEnums::class)],
            'hire_date'     => 'required|date',
            'birth_date'    => 'required|date',
            'salary'        => 'required|integer',
            'title'         => 'required|string|max:50',
        ];
    }
}
