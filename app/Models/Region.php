<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = ['name'];

    protected $appends = [
        'created_at_formatted'
    ];
}
