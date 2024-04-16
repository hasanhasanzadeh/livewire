<?php

namespace App\Models;

use App\Base\Trait\HasRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Article extends Model
{
    use HasFactory, HasRules;

    protected $table = 'articles';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'author_id'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static $rules = [
        'title' => 'required|string|min:3|max:150',
        'slug' => 'required|string|min:3|max:70|unique:articles,slug',
        'content' => 'nullable|string',
        'image' => 'required|image|mimes:png,jpg,webp,jpeg,gif,svg,bmp,avif|max:2048',
    ];

    /*
     * -------------------------
     *      Relations
     * -------------------------
     */

    public function photo(): morphOne
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
