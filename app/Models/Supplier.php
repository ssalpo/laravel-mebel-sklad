<?php

namespace App\Models;

use App\Models\Traits\CurrentUser;
use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, CurrentUser, DatesFormatable, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $appends = [
        'created_at_formatted'
    ];
}
