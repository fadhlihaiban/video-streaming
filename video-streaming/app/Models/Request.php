<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'video_id',
        'status',
        'approved_until',
    ];

    protected $dates = ['approved_until'];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}