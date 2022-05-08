<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "status_id",
        "user_id",
        "name",
        "surname",
        "phone",
        "email",
        "country",
        "city",
        "address",
        "total",
        "vendor_order_id",
        "transaction_id",
        "invoice_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'single_price']);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function isCompleted(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status->name === config('constants.db.order_statuses.completed')
        );
    }

    public function inProcess(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status->name === config('constants.db.order_statuses.in_process')
        );
    }

    public function isCanceled(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status->name === config('constants.db.order_statuses.cancel')
        );
    }

    public function isPaid(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status->name === config('constants.db.order_statuses.paid')
        );
    }

    public function orderTax(): Attribute
    {
        return new Attribute(
            get: function () {
                $products = $this->products()->get();
                $sum = 0;

                foreach($products as $product) {
                    $sum += $product->pivot->quantity * $product->pivot->single_price;
                }

                return $this->total - $sum;
            }
        );
    }
}
