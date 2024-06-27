<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
