<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterInvitation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'unique_id',
        'register_date_time',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
