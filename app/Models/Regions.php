<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function federalDistricts()
    {
        return $this->belongsTo(FederalDistricts::class);
    }

    public function cities()
    {
        return $this->hasMany(Cities::class);
    }
}
