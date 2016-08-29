<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccountRequest extends Request
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
            'full_name' =>'required',
            'phone_number' => 'required|numeric',
            'identity_card' => 'required|numeric',
            'university_id' => 'required',
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Vui lòng điền họ và tên',
            'phone_number.required'  => 'Vui lòng điền số điện thoại',
            'phone_number.numeric'  => 'Số điện thoại không hợp lệ',
            'identity_card.required'  => 'Vui lòng điền số chứng minh nhân dân',
            'identity_card.numeric'  => 'Số chứng minh nhân dân không hợp lệ',
            'university_id.required' => 'Vui lòng chọn trường đại học của bạn',
            'email.required'  => 'Vui lòng điền email',
            'email.email'  => 'Email không hợp lệ',
            'g-recaptcha-response.required' => 'Vui lòng nhập captcha'
        ];
    }
}
