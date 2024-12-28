<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalDistricts extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function regions()
    {
        return $this->hasMany(Regions::class);
    }
}
