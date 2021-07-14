<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name_ar' => 'required',
            'name_en' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => trans('sections.required_ar'),
            'name_en.required' => trans('sections.required_en'),
            'grade_id.required' => trans('sections.Grade_id_required'),
            'classroom_id.required' => trans('sections.Class_id_required'),
        ];
    }
}
