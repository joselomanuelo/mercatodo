<?php

namespace App\Models;

use App\Models\Concerns\UserRoutes;
use App\Models\Concerns\UserViews;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, Authorizable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use UserRoutes;
    use UserViews;

    protected $fillable = [
        'name',
        'email',
        'password',
        'disabled_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeSearch(Builder $query, ?string $search = null): Builder
    {
        return $search ? $query->where('name', 'like', '%'.trim($search).'%')
            ->orWhere('email', 'like', '%'.trim($search).'%') : $query;
    }
}
