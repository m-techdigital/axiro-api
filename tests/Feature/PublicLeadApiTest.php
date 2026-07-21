<?php

namespace Tests\Feature;

use App\Mail\PublicLeadSubmitted;
use App\Models\PublicLead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PublicLeadApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_public_lead_and_sends_admin_mail(): void
    {
        Mail::fake();

        $response = $this->postJson('/api/v1/public/leads', [
            'full_name' => 'Nguyen Van A',
            'phone' => '0901234567',
            'email' => 'a@example.com',
            'company_name' => 'AXIRO Demo',
            'job_title' => 'CEO',
            'company_size' => '10-50',
            'interest' => 'Tư vấn triển khai AXIRO',
            'message' => 'Tôi muốn được tư vấn.',
            'consent' => true,
            'lang' => 'vi',
            'page_url' => 'https://axiro.vn/#contact',
            'utm_source' => 'test',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('message', 'AXIRO đã nhận thông tin. Đội ngũ tư vấn sẽ liên hệ lại trong thời gian sớm nhất.')
            ->assertJsonMissingPath('data');

        $this->assertDatabaseHas('public_leads', [
            'full_name' => 'Nguyen Van A',
            'phone' => '0901234567',
            'email' => 'a@example.com',
        ]);

        $lead = PublicLead::first();

        Mail::assertSent(PublicLeadSubmitted::class, fn (PublicLeadSubmitted $mail) => (
            $mail->lead->is($lead)
        ));
    }

    public function test_it_validates_required_public_lead_fields(): void
    {
        $this->postJson('/api/v1/public/leads', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['full_name', 'phone', 'interest', 'consent']);
    }

    public function test_it_returns_english_success_message_when_requested(): void
    {
        Mail::fake();

        $this->postJson('/api/v1/public/leads', [
            'full_name' => 'John Smith',
            'phone' => '0901234567',
            'interest' => 'AXIRO implementation consulting',
            'consent' => true,
            'lang' => 'en',
        ])
            ->assertCreated()
            ->assertJsonPath('message', 'AXIRO has received your request. Our consulting team will contact you as soon as possible.');
    }

    public function test_it_returns_english_validation_messages_when_requested(): void
    {
        $this->postJson('/api/v1/public/leads', ['lang' => 'en'])
            ->assertUnprocessable()
            ->assertJsonPath('errors.full_name.0', 'Please enter your full name.')
            ->assertJsonPath('errors.phone.0', 'Please enter your phone number.')
            ->assertJsonPath('errors.interest.0', 'Please select an area of interest.')
            ->assertJsonPath('errors.consent.0', 'Please agree that AXIRO may contact you.');
    }
}
