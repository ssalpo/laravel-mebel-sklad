<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Nomenclature;
use App\Models\Showcase;
use App\Models\Unit;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function nomenclatures()
    {
        return $this->transformCollection(
            Nomenclature::when(
                request('q'),
                static fn($q, $v) => $q->where('name', 'like', '%' . $v . '%')
                    ->orWhereBarcode($v)
            )->get()
        );
    }

    public function clients()
    {
        return $this->transformCollection(
            Client::when(
                request('q'),
                static fn($q, $v) => $q->where('name', 'like', '%' . $v . '%')
            )->get()
        );
    }

    public function showcases()
    {
        return $this->transformCollection(
            Showcase::when(
                request('q'),
                static fn($q, $v) => $q->where('name', 'like', '%' . $v . '%')
            )->get()
        );
    }

    public function units()
    {
        return $this->transformCollection(
            Unit::when(
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
