<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id', 'salon_name', 'description', 'min_people', 'max_people', 'street', 'number', 'city', 'postcode'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'salon_tag');
    }
}
