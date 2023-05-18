<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NomenclatureArrival extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'nomenclature_id',
        'supplier_id',
        'quantity',
        'base_price',
        'price_for_sale',
        'comment',
    ];

    protected $casts = [
        'quantity' => 'double'
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public function nomenclature(): BelongsTo
    {
        return $this->belongsTo(Nomenclature::class)->withTrashed();
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
