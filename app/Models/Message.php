<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_read',
    ];

    /**
     * Sender relationship
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Receiver relationship
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function scopeUnreadFor($query, $userId)
    {
        return $query->where('receiver_id', $userId)->where('is_read', false);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('receiver_id', $userId)->with('sender');
    }
}
