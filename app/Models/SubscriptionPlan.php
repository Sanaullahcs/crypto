<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'duration',
        'price',
        'description',
        'product_id',
        'price_id',
        'paypal_product_id',
        'paypal_price_id',
        'duration',
        'best_value'
        

        // Add more fillable fields as needed
    ];
}
