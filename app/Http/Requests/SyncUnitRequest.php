<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncUnitRequest extends FormRequest
{
    const UNITS = 'unit';
    const NUMBER = 'unit .*. number';
    const PRICE = 'unit .*. price';

    public function rules(): array
    {
        return [
            self::UNITS => [
                'required',
                'array'
            ],

            self::NUMBER => [
                'required',
                'string'
            ],

            self::PRICE => [
                'required',
                'integer'
            ]
        ];
    }

    public function getUnit(): array
    {
        return $this->get(self::UNITS);
    }
}
