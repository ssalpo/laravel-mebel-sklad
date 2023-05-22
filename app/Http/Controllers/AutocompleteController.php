<?php

namespace App\Http\Controllers;

use App\Models\Nomenclature;
use App\Models\Region;
use App\Models\Supplier;

class AutocompleteController extends Controller
{
    public function nomenclatures()
    {
        return $this->transformCollection(
            Nomenclature::when(
                request('q'),
                static fn($q, $v) => $q->where('name', 'like', '%' . $v . '%')
                    ->orWhere('barcode', 'like', '%' . $v . '%')
            )->get()
        );
    }

    public function suppliers()
    {
        return $this->transformCollection(
            Supplier::when(
                request('q'),
                static fn($q, $v) => $q->where('name', 'like', '%' . $v . '%')
            )->get()
        );
    }

    public function regions()
    {
        return $this->transformCollection(
            Region::when(
                request('q'),
                static fn($q, $v) => $q->where('name', 'like', '%' . $v . '%')
            )->get()
        );
    }

    private function transformCollection($items)
    {
        return $items->transform(fn($m) => [
            'id' => $m->id,
            'text' => $m->name
        ]);
    }
}
