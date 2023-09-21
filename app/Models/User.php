<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\Permission\Traits\HasRoles;
use App\Models\UserAlert;

class User extends Authenticatable implements HasMedia,MustVerifyEmail
{
    use Notifiable, HasRoles, InteractsWithMedia,HasRoles,Notifiable,HasFactory,InteractsWithMedia;

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $with = ['media'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->useFallbackUrl('https://www.gravatar.com/avatar/' . md5("test@mail.com"));
    }
    public function scopeIsActive(Builder $builder) {
        return $builder->where('is_active', 1);
    }

    // Your other methods and relationships...
      // Define the property to check if the user is email verified
      protected $appends = ['is_email_verified'];
      public function getIsEmailVerifiedAttribute()
      {
          return $this->email_verified_at !== null;
      }
      public function userAlerts()
      {
          return $this->hasMany(UserAlert::class);
      }

}
