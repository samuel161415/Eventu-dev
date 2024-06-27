<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_tag');
    }

    public function salon()
    {
        return $this->belongsToMany(Business::class, 'salon_tag');
    }
}
