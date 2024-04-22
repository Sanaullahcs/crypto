<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','code','stripe_coupon_id', 'discount', 'is_active','one_time','is_used','is_coupon_show_home_page','expiry_date'];
}
