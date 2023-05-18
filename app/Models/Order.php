<?php

namespace App\Models;

use App\Models\Scopes\CurrentCompanyScope;
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
        'showcase_id',
        'company_id',
        'user_id',
        'client_id',
        'amount',
        'profit',
        'status',
        'cancel_reason',
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

    protected static function booted(): void
    {
        static::addGlobalScope(new CurrentCompanyScope);
    }

    public function scopeFilter($q, $data): void
    {
        $q->when(
            Arr::get($data, 'showcase'),
            fn($q, $v) => $q->where('showcase_id', $v)
        );

        $q->when(
            Arr::get($data, 'query'),
            fn($q, $v) => $q->where('id', $v)
                ->orWhere('amount', $v)
                ->orWhere('profit', $v)
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
            Arr::get($data, 'client'),
            fn($q, $v) => $q->where('client_id', $v)
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

    public function showcase(): BelongsTo
    {
        return $this->belongsTo(Showcase::class)->withTrashed();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
