<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function regions()
    {
        return $this->belongsTo(Regions::class);
    }

    public function premises()
    {
        return $this->hasMany(Premise::class);
    }
}
