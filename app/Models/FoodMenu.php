<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id', 'menu_name', 'short_description', 'pdf_url', 'price', 'allergens'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'food_menu_tag');
    }
}
