<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeDefaultStatus($query)
    {
        return $query->where('name', config('constants.db.order_statuses.in_process'));
    }
}
