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
            'lang' => ['nullable', 'in:vi,en'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => __('public_leads.validation.full_name_required'),
            'full_name.max' => __('public_leads.validation.full_name_max'),
            'phone.required' => __('public_leads.validation.phone_required'),
            'phone.max' => __('public_leads.validation.phone_max'),
            'phone.regex' => __('public_leads.validation.phone_regex'),
            'email.email' => __('public_leads.validation.email_email'),
            'email.max' => __('public_leads.validation.email_max'),
            'company_name.max' => __('public_leads.validation.company_name_max'),
            'job_title.max' => __('public_leads.validation.job_title_max'),
            'company_size.max' => __('public_leads.validation.company_size_max'),
            'interest.required' => __('public_leads.validation.interest_required'),
            'interest.max' => __('public_leads.validation.interest_max'),
            'message.max' => __('public_leads.validation.message_max'),
            'consent.accepted' => __('public_leads.validation.consent_accepted'),
            'page_url.url' => __('public_leads.validation.page_url_url'),
            'page_url.max' => __('public_leads.validation.page_url_max'),
            'utm_source.max' => __('public_leads.validation.utm_source_max'),
            'utm_medium.max' => __('public_leads.validation.utm_medium_max'),
            'utm_campaign.max' => __('public_leads.validation.utm_campaign_max'),
            'website_url.prohibited' => __('public_leads.validation.website_url_prohibited'),
        ];
    }
}
