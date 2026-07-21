<?php

use App\Http\Controllers\Api\V1\PublicLeadController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('/public/leads', PublicLeadController::class)
        ->middleware('throttle:public-leads');
});
