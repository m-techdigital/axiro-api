<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicLead extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'company_name',
        'job_title',
        'company_size',
        'interest',
        'message',
        'consent',
        'page_url',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'ip_address',
        'user_agent',
        'mailed_at',
    ];

    protected function casts(): array
    {
        return [
            'consent' => 'boolean',
            'mailed_at' => 'datetime',
        ];
    }
}
