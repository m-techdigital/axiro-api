<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePublicLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:160'],
            'phone' => ['required', 'string', 'max:40', 'regex:/^[0-9+\-\s().]{8,20}$/'],
            'email' => ['nullable', 'email', 'max:180'],
            'company_name' => ['nullable', 'string', 'max:180'],
            'job_title' => ['nullable', 'string', 'max:160'],
            'company_size' => ['nullable', 'string', 'max:120'],
            'interest' => ['required', 'string', 'max:180'],
            'message' => ['nullable', 'string', 'max:3000'],
            'consent' => ['accepted'],
            'page_url' => ['nullable', 'url', 'max:2048'],
            'utm_source' => ['nullable', 'string', 'max:120'],
            'utm_medium' => ['nullable', 'string', 'max:120'],
            'utm_campaign' => ['nullable', 'string', 'max:160'],
            'website_url' => ['nullable', 'prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại chưa đúng định dạng.',
            'email.email' => 'Email chưa đúng định dạng.',
            'interest.required' => 'Vui lòng chọn nhu cầu quan tâm.',
            'consent.accepted' => 'Vui lòng đồng ý để AXIRO liên hệ tư vấn.',
            'website_url.prohibited' => 'Yêu cầu không hợp lệ.',
        ];
    }
}
