<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id', 'role', 'action', 'table_name', 'record_id', 'changes', 'ip_address', 'user_agent'
    ];

    protected $casts = [
        'changes' => 'array',
    ];
}
