<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEvent extends Model
{
    use HasFactory;

    protected $table = 'business_events';

    protected $fillable = [
        'business_id',
        'event_category_id',
        'min_price',
        'max_price',
    ];
}
