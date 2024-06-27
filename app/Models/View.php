<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'user_id',
        'ip_address',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
