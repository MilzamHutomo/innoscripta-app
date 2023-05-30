<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function isAdmin(): Attribute 
    {
        return new Attribute(
            get: fn () => $this->role === self::TYPE_ADMIN
        );
    }

    protected function isManager(): Attribute
    {
        return new Attribute(
            get: fn () => $this->role === self::TYPE_MANAGER
        );
    }

    public const TYPE_ADMIN = 'ADMIN';
    public const TYPE_MANAGER = 'MANAGER';
    public const TYPE_REPRESENTATIVE = 'REPRESENTATIVE';

    public const TYPE_AVAILABLE = [
        self::TYPE_ADMIN,
        self::TYPE_MANAGER,
        self::TYPE_REPRESENTATIVE
    ];

    public function templates()
    {
        return $this->hasMany(WorkflowTemplate::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', self::TYPE_ADMIN);
    }

    public function scopeNotAdmin($query)
    {
        return $query->whereIn('role', [self::TYPE_MANAGER, self::TYPE_REPRESENTATIVE]);
    }

    public function scopeManager($query)
    {
        return $query->where('role', self::TYPE_MANAGER);
    }

    public function scopeRepresentative($query)
    {
        return $query->where('role', self::TYPE_REPRESENTATIVE);
    }
}
