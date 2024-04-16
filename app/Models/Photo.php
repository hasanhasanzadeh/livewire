<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';
    protected $fillable = [
        'original_name',
        'path',
        'photoable_id',
        'photoable_type',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /*
     * ------------------------
     *      relations
     * ------------------------
     *
     */
    public function photoable()
    {
        return $this->morphTo();
    }
}
