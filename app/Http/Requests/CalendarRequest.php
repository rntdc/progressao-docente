<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalendarRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust the authorization logic if needed
    }

    public function rules()
    {
        $semesterStartDate = $this->input('start_date');
        $semesterEndDate = $this->input('end_date');

        return [
            'semester' => [
                'required',
                Rule::unique('calendars')->where(function ($query) use ($semesterStartDate, $semesterEndDate) {
                    return $query->where('start_date', '<=', $semesterEndDate)
                        ->where('end_date', '>=', $semesterStartDate);
                }),
                Rule::unique('calendars')->where(function ($query) {
                    return $query->where('semester', $this->input('semester'));
                }),
            ],
            'start_date' => [
                'required',
                'date',
                'before:end_date',
                Rule::unique('calendars')->where(function ($query) {
                    return $query->where('semester', $this->input('semester'))
                        ->where(function ($query) {
                            $query->where('start_date', '>=', $this->input('start_date'))
                                  ->where('start_date', '<=', $this->input('end_date'));
                        })
                        ->orWhere(function ($query) {
                            $query->where('end_date', '>=', $this->input('start_date'))
                                  ->where('end_date', '<=', $this->input('end_date'));
                        });
                }),
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
                Rule::unique('calendars')->where(function ($query) {
                    return $query->where('semester', $this->input('semester'))
                        ->where(function ($query) {
                            $query->where('start_date', '>=', $this->input('start_date'))
                                  ->where('start_date', '<=', $this->input('end_date'));
                        })
                        ->orWhere(function ($query) {
                            $query->where('end_date', '>=', $this->input('start_date'))
                                  ->where('end_date', '<=', $this->input('end_date'));
                        });
                }),
            ],
        ];
    }
}
