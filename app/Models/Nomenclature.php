<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomenclature extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'name',
        'base_price',
        'price_for_sale',
        'barcode'
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public function nomenclatureArrivals(): HasMany
    {
        return $this->hasMany(NomenclatureArrival::class);
    }
}
