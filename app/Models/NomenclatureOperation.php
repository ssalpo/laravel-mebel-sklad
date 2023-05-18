<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NomenclatureOperation extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'company_id',
        'nomenclature_id',
        'type',
        'quantity',
        'base_price',
        'comment',
    ];

    protected $casts = [
        'type' => 'int',
        'quantity' => 'double'
    ];

    public const OPERATION_TYPE_WITHDRAW = 1;
    public const OPERATION_TYPE_REFUND = 2;

    public const OPERATION_LABELS = [
        self::OPERATION_TYPE_WITHDRAW => 'Списание',
        self::OPERATION_TYPE_REFUND => 'Возврат',
    ];

    public function nomenclature(): BelongsTo
    {
        return $this->belongsTo(Nomenclature::class)->withTrashed();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
