<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesProofs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function report()
    {
        return $this->belongsTo(Reports::class);
    }
}
