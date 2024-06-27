<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'icon'];

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_events', 'event_category_id', 'business_id');
    }
}
