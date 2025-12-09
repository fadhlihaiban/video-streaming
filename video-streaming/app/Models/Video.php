<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Request as VideoRequest;


class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'youtube_id'
    ];

    public function requests()
    {
        return $this->hasMany(Reuqest::class);
    }
}