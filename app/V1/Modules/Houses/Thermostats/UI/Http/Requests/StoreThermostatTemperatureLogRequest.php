<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\UI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreThermostatTemperatureLogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'device_id' => [
                'required',
                'string',
                'exists:thermostats,id',
            ],
            'temperature' => [
                'required',
                'numeric',
                'min:-100',
                'max:100',
            ],
            'date' => [
                'required',
                'date_format:U',
            ],
        ];
    }
}
