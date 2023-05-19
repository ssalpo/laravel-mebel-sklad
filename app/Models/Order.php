<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'user_id',
        'amount',
        'profit',
        'status',
        'client_name',
        'phone_number',
        'phone',
        'address',
        'deposit_amount',
        'cancel_reason',
    ];

    protected $casts = [
        'deposit_amount' => 'double',
        'profit' => 'double',
        'amount' => 'double',
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public const STATUS_SOLD = 1;
    public const STATUS_CANCELED = 2;

    public const STATUS_LABELS = [
        self::STATUS_SOLD => 'Продано',
        self::STATUS_CANCELED => 'Отменен',
    ];

    public function scopeFilter($q, $data): void
    {
        $q->when(
            Arr::get($data, 'query'),
            fn($q, $v) => $q->where('id', $v)
                ->orWhere('amount', $v)
                ->orWhere('address', 'like', '%' . $v . '%')
                ->orWhere('phone', 'like', '%' . $v . '%')
                ->orWhere('client_name', 'like', '%' . $v . '%')
        );

        $q->when(
            Arr::get($data, 'created_start'),
            function ($q) use ($data) {
                $dateFrom = Carbon::parse(Arr::get($data, 'created_start', ''))->startOfDay();

                $dateTo = Carbon::parse(
                    Arr::get(
                        $data, 'created_end',
                        $dateFrom ? $dateFrom->clone()->endOfDay() : ''
                    )
                )->endOfDay();

                $q->whereBetween('created_at', [$dateFrom, $dateTo]);
            }
        );

        $q->when(
            Arr::get($data, 'user'),
            fn($q, $v) => $q->where('user_id', $v)
        );

        $q->when(
            Arr::get($data, 'id'),
            fn($q, $v) => $q->where('id', $v)
        );
    }

    public function scopeSold($q): void
    {
        $q->where('status', self::STATUS_SOLD);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function markAsPaid()
    {
        return $this->update(['deposit_amount' => 0]);
    }
}
