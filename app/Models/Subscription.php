<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'user_id',
        'subscription_id',
        'name',
        'stripe_id ',
        'stripe_status',
        'payment_id',
        'stripe_price',
        'last4',
        'card_brand',
        'quantity',
        'trial_ends_at',
        'ends_at',
        'type',
        'registerdiscount',
        'couponcode',
        'invoice_number'


        // Add other fillable columns
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
