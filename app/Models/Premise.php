<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premise extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(ImagesPremises::class , 'premise_id');
    }

    public function federalDistricts()
    {
        return $this->hasOneThrough(FederalDistricts::class, Regions::class, 'id', 'id', 'region_id', 'district_id');
    }

    public function regions()
    {
        return $this->hasOneThrough(Regions::class, Cities::class, 'id', 'id', 'city_id', 'region_id');
    }

    public function cities(){
        return $this->belongsTo(Cities::class, 'city_id');
    }
}
