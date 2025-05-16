<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    public function premise()
    {
        return $this->hasMany(Premise::class);
    }

    public function savedPremises()
    {
        return $this->belongsToMany(Premise::class, 'saved_premises');
    }

    public function report()
    {
        return $this->hasMany(Reports::class, 'user_id');
    }

    public function rewiev()
    {
        return $this->hasMany(Reviews::class);
    }



}
