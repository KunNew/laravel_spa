<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'avatar',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function setAvatarAttribute($value)
    {
        if (isset($value))
        {
            // remove old avatar on update
            if ($this->avatar) Storage::disk('public')->delete($this->avatar);
            $path = $value->store('user/'.date('FY'), ['disk' => 'public']);
            $this->attributes['avatar'] = $path;
        }
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($item) {
            if ($item->avatar) Storage::disk('public')->delete($item->avatar);
        });
    }

    public function findForPassport($username)
    {
        return $this->where('username', $username)->orWhere('email', $username)->first();
    }
}
