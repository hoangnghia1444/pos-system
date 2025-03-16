<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['dining_table_id', 'total_amount', 'status'];

    public function diningTable()
    {
        return $this->belongsTo(DiningTable::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
