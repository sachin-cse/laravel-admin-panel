<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitylog extends Model
{
    use HasFactory;

    protected $table = 'activity_log';
    protected $fillable = [
        'id',
        'current_logged_id',
        'ip_address',
        'user_type',
        'user_name',
        'device_access'
    ];
}
