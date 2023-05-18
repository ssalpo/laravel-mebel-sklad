<?php

namespace App\Models;

use App\Models\Scopes\CurrentCompanyScope;
use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DebtPayment extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'client_debt_id',
        'created_by',
        'amount',
    ];

    protected $casts = [
        'amount' => 'double'
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public function debt(): BelongsTo
    {
        return $this->belongsTo(Debt::class);
    }
}
