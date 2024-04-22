<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{

    protected $table = 'payment_transaction';
    use HasFactory;
    protected $fillable = [
        'payment_intent_id',
        'object',
        'amount',
        'amount_capturable',
        'amount_details',
        'amount_received',
        'capture_method',
        'client_secret',
        'confirmation_method',
        'created',
        'currency',
        'latest_charge',
        'livemode',
        'payment_method',
        'payment_method_configuration_details',
        'payment_method_options',
        'payment_method_types',
        'status',
        'type',
        'couponcode',
        'register_couponcode'

        // Add other fields here if necessary
    ];

    protected $casts = [
        'amount_details' => 'json',
        'payment_method_configuration_details' => 'json',
        'payment_method_options' => 'json',
        'payment_method_types' => 'json',
        // Add other JSON fields here if necessary
    ];
    
    // Optional: Define casts for JSON fields
   
}
