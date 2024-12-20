<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesPremises extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function premise()
    {
        return $this->belongsTo(Premise::class);
    }
}
