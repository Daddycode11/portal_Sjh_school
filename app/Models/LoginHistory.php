<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LoginHistory extends Model
{
    use HasFactory;

    // Table name (optional if your table is not 'login_histories')
    protected $table = 'login_histories';

    // Disable timestamps if your table does not have created_at/updated_at
    public $timestamps = false;

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'logged_in_at',
    ];

    /**
     * Relationship: LoginHistory belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
