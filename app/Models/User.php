<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $guarded = [];
  protected $hidden = [
    'password',
    'remember_token',
  ];
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function categories(): HasMany
  {
    return $this->hasMany(Category::class);
  }

  public function tasks(): HasMany
  {
    return $this->hasMany(Task::class);
  }
}
