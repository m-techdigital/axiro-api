<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('public_leads', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone', 40);
            $table->string('email')->nullable();
            $table->string('company_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('company_size')->nullable();
            $table->string('interest');
            $table->text('message')->nullable();
            $table->boolean('consent')->default(false);
            $table->string('page_url', 2048)->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent', 1024)->nullable();
            $table->timestamp('mailed_at')->nullable();
            $table->timestamps();

            $table->index(['phone', 'created_at']);
            $table->index(['email', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_leads');
    }
};
