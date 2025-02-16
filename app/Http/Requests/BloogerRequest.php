<?php

namespace App\Http\Requests;
use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class BloogerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string','unique:users','email'],
            'password' => ['required','string','min:8'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    protected function passedValidation()
    {
        // set role to blogger if null
        if (is_null($this->role)) {
          //  dd(vars: '1');

            $this->merge(['role' => UserRoleEnum::BLOGGER->value]);
        }
    }


}
