<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StorePublicLeadRequest;
use App\Mail\PublicLeadSubmitted;
use App\Models\PublicLead;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class PublicLeadController extends Controller
{
    public function __invoke(StorePublicLeadRequest $request): JsonResponse
    {
        $lead = PublicLead::create([
            ...$request->safe()->except('website_url', 'lang'),
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 1024),
        ]);

        Mail::to(config('services.public_leads.admin_email'))
            ->send(new PublicLeadSubmitted($lead));

        $lead->forceFill(['mailed_at' => now()])->save();

        return response()->json([
            'message' => __('public_leads.success'),
        ], 201);
    }
}
