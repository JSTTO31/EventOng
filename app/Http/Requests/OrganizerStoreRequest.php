<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizerStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'general_contact_details' => ['required', 'string'],
            'email_address' => ['required', 'string'],
            'physical_address' => ['required', 'string'],
            'twitter_link' => ['nullable', 'string'],
            'instagram_link' => ['nullable', 'string'],
            'youtube_link' => ['nullable', 'string'],
            'whats_app_link' => ['nullable', 'string'],
            'tiktok_link' => ['nullable', 'string'],
            'facebook_link' => ['nullable', 'string'],
            'linkedin_link' => ['nullable', 'string'],
            'organizer_link' => ['nullable', 'string'],
            'open_new_tab' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
