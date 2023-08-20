<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'status' => ['required', 'in:scheduled,cancelled,moved,postponed,rescheduled'],
            'mode' => ['required', 'in:physical,online,both'],
            'date_time.event_date_start' => ['nullable', 'date'],
            'date_time.event_time_start' => ['nullable', 'string'],
            'date_time.event_date_end' => ['nullable', 'date'],
            'date_time.event_time_end' => ['nullable', 'string'],
            'date_time.hide_end' => ['nullable', 'boolean'],
            'date_time.month_long' => ['nullable', 'boolean'],
            'date_time.year_long' => ['nullable', 'boolean'],
            'date_time.progress_bar' => ['nullable', 'boolean'],
            'health_guideline.enable' => ['nullable', 'boolean'],
            'health_guideline.face_mask' => ['nullable', 'boolean'],
            'health_guideline.temperature' => ['nullable', 'boolean'],
            'health_guideline.physical_distance' => ['nullable', 'boolean'],
            'health_guideline.sanitize_before_event' => ['nullable', 'boolean'],
            'health_guideline.held_outside' => ['nullable', 'boolean'],
            'health_guideline.vaccination' => ['nullable', 'boolean'],
            'health_guideline.other' => ['nullable', 'boolean'],
            'location_id' => ['nullable', 'exists:locations,id'],
            'organzer_id' => ['nullable', 'exists:organzers,id'],
            'link' => ['nullable', 'string']
        ];
    }
}
