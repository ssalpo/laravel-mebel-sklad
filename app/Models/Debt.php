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

class Debt extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'client_id',
        'created_by',
        'order_id',
        'amount',
        'comment',
        'is_paid'
    ];

    protected $casts = [
        'amount' => 'double',
        'is_paid' => 'bool',
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public function scopeFilters($q, array $data = [])
    {
        $q->when(
            Arr::get($data, 'query'),
            fn($q, $v) => $q->whereId($v)
                ->orWhere('comment', 'like', '%' . $v . '%')
                ->orWhere('amount', $v)
        );

        $q->when(
            Arr::get($data, 'client'),
            fn($q, $v) => $q->whereClientId($v)
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
    }

    public function scopeNotPaid($q)
    {
        $q->where('is_paid', false);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class)->withTrashed();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(DebtPayment::class);
    }

    public function markAsPaid()
    {
        return $this->update(['is_paid' => true]);
    }
}
