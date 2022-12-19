<?php

namespace App\Http\Requests;

use App\Attendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function validationRules()
    {
        return [
            'event_id' => [
                'required',
                'exists:events,id',
            ],
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'regex:/^[0-9+]{9,15}$/',
            ],
            'email' => [
                'required',
                'email',
                'unique:attendances,email,'.$this->route('attendance')->id,
            ],
            'designation' => [
                'required',
                'string',
                'max:255',
            ],
            'organization' => [
                'required',
                'string',
                'max:255',
            ],
            'country' => [
                'required',
                'string',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'max:255',
            ],
            'amenities' => [
                'array',
            ],
        ];
    }
}
