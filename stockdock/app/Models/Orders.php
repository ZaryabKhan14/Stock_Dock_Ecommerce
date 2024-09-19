<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','email','first_name','last_name', 'delivery_note','status','address', 'phone', 'total_amount','city','payment_method'];

    public function items()
    {
        return $this->hasMany(Orders_items::class,'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
