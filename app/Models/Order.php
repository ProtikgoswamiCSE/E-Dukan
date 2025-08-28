<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'total_amount',
        'payment_method',
        'payment_status',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'shipping_country',
        'notes',
        'delivered_at'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'delivered_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . strtoupper(uniqid());
            }
        });
    }

    /**
     * Get the user that owns the order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items for this order
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'delivered' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Get payment status display text
     */
    public function getPaymentStatusDisplayAttribute(): string
    {
        if ($this->status === 'cancelled') {
            return 'Order Cancelled';
        }
        
        if ($this->status === 'delivered') {
            return 'Payment Complete';
        }
        
        return 'Pending';
    }

    /**
     * Get payment status badge color
     */
    public function getPaymentStatusBadgeAttribute(): string
    {
        if ($this->status === 'cancelled') {
            return 'danger';
        }
        
        if ($this->status === 'delivered') {
            return 'success';
        }
        
        return 'warning';
    }

    /**
     * Update payment status based on order status
     */
    public function updatePaymentStatusFromOrderStatus(): void
    {
        $paymentStatus = 'pending';
        
        if ($this->status === 'delivered') {
            $paymentStatus = 'paid';
        } elseif ($this->status === 'cancelled') {
            $paymentStatus = 'cancelled';
        }
        
        $this->update(['payment_status' => $paymentStatus]);
    }

    /**
     * Check if the order can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Cancel the order
     */
    public function cancel(): bool
    {
        if (!$this->canBeCancelled()) {
            return false;
        }

        $this->update(['status' => 'cancelled']);
        $this->updatePaymentStatusFromOrderStatus();
        
        return true;
    }
}
