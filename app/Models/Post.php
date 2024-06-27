<?php
namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'is_published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMetaTitleAttribute()
    {
        return $this->meta_title ?? $this->title;
    }

    public function getMetaDescriptionAttribute()
    {
        // return $this->meta_description ?? Str::limit(strip_tags($this->content), 160);
    }

    public function getMetaKeywordsAttribute()
    {
        return $this->meta_keywords ?? implode(',', $this->generateKeywords());
    }

    private function generateKeywords()
    {
        $keywords = array_merge(
            explode(' ', $this->title),
            explode(' ', strip_tags($this->content))
        );
        return array_unique(array_filter($keywords));
    }
}
