<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBanner extends Model
{
    use HasFactory;

    protected $table = 'service_banner';

    protected $fillable = ['banner_name', 'banner_image', 'service_id'];
}
