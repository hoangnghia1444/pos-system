<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningTable extends Model
{
    use HasFactory;
    protected $fillable = ['table_number', 'capacity'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
