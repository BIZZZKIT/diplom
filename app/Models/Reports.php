<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    const statuses = ['На рассмотрении', 'Отклонена', 'Решено'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function premise()
    {
        return $this->belongsTo(Premise::class);
    }

    public function imagesProofs()
    {
        return $this->hasMany(ImagesProofs::class, 'report_id');
    }
    public function userSender()
    {
        return $this->belongsTo(User::class, 'userSend_id');
    }
}
