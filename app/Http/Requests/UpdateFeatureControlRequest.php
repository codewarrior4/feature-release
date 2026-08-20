<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateFeatureControlRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'feature' => ['required', 'string', Rule::in(['emergency_brake', 'launch_mode', 'operator_console'])],
            'state' => ['nullable', 'string', Rule::in(['on', 'off'])],
            'value' => ['nullable', 'string', Rule::in(['steady', 'canary', 'wide'])],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($this->string('feature')->toString() === 'launch_mode' && ! $this->filled('value')) {
                $validator->errors()->add('value', 'A launch mode value is required.');
            }

            if ($this->string('feature')->toString() !== 'launch_mode' && ! $this->filled('state')) {
                $validator->errors()->add('state', 'A toggle state is required.');
            }
        });
    }
}
