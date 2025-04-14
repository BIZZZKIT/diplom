<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremisePanorama extends Model
{
    use HasFactory;

    protected $fillable = [
        'premise_id',
        'room_name',
        'path'
    ];

    public function premise()
    {
        return $this->belongsTo(Premise::class);
    }
}
