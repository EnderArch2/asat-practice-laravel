<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $datePrefix = now()->format('Ymd');
            $randomString = strtoupper(Str::random(5));

            $order->invoice_number = 'INV-' . $datePrefix . '-' . $randomString;
        });
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function items() : HasMany {
        return $this->hasMany(OrderItem::class);
    }
}
