<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Use protected here — correct visibility for Laravel
    protected $fillable = [
        'title',
        'content',
        'target_audience',
        'posted_at',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
    ];
}