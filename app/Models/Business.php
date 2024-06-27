<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slogan', 'short_description', 'city', 'district', 'address', 'location_id', 'pret_min_nunta', 'pret_min_botez', 'slug',
        'profile_picture_url', 'cover_photo_url', 'phone', 'email', 'website_url',
        'fiscal_attribute', 'identification_code', 'control_digit', 'registration_prefix',
        'county_code', 'order_number', 'registration_year', 'latitude', 'longitude'
    ];
    public function location() : BelongsTo
    {
        return $this->belongsTo(Location::class); 
    }

    public function eventCategories()
    {
        return $this->belongsToMany(EventCategory::class, 'business_events', 'business_id', 'event_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'business_tag');
    }
    public function foodMenus()
    {
        return $this->hasMany(FoodMenu::class);
    }


    public function salons(): HasMany
    {
        return $this->hasMany(Salon::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Get all of the business's media.
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
