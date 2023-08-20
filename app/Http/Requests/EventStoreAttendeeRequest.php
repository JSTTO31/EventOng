<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreAttendeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'email' => ['string', 'required', 'email'],
            'address' => ['string', 'required'],
            'mobile' => ['string', 'required', 'min:10', 'max:10'],
        ];
    }
}
