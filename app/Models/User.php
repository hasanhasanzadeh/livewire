<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Base\Trait\HasRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRules, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mobile_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    protected static $rules = [
        'first_name' => 'nullable|string|min:3|max:50',
        'last_name' => 'nullable|string|min:3|max:50',
        'email' => 'required|email|unique:users,email|max:150',
        'mobile' => 'nullable|unique:users,mobile|digits:11',
        'password' => 'required|string|min:6|max:32',
        'avatar' => 'nullable|image|mimes:png,jpg,webp,jpeg,gif,svg,bmp,avif|max:2048',
    ];

    public function avatar(): morphOne
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function articles(): hasMany
    {
        return $this->hasMany(Article::class, 'author_id', 'id');
    }
}
