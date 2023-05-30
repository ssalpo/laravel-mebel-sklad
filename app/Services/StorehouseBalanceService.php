<?php

namespace App\Services;

use App\Models\NomenclatureArrival;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StorehouseBalanceService
{
    private array $filters = [];

    public function getNomenclatureBalances()
    {
        $orderItems = OrderItem::select(
            'nomenclature_id',
            DB::raw('SUM(quantity) as quantity')
        )->join(
            'orders',
            fn($q) => $q->on('orders.id', '=', 'order_items.order_id')
                ->where('orders.status', Order::STATUS_SOLD)
        )
            ->groupBy('nomenclature_id')
            ->get();

        return NomenclatureArrival::select(
            'nomenclature_id',
            DB::raw('n.name AS nomenclature_name'),
            DB::raw('n.base_price AS nomenclature_base_price'),
            DB::raw('SUM(quantity) AS quantity'),
        )->join(
            'nomenclatures as n',
            fn($q) => $q->on('n.id', '=', 'nomenclature_arrivals.nomenclature_id')
                ->when(
                    Arr::get($this->filters, 'query'),
                    fn($q, $v) => $q->where('name', 'like', '%' . $v . '%')
                )
        )
            ->groupBy('nomenclature_id')
            ->get()
            ->transform(function ($m) use ($orderItems) {
                $orderItem = $orderItems->where('nomenclature_id', $m->nomenclature_id)->first();

                return [
                    'id' => $m->nomenclature_id,
                    'nomenclature' => [
                        'name' => $m->nomenclature_name,
                        'base_price' => $m->nomenclature_base_price,
                    ],
                    'quantity' => $m->quantity - ($orderItem?->quantity ?? 0),
                ];
            });
    }

    public function setFilters(array $filters): StorehouseBalanceService
    {
        $this->filters = $filters;

        return $this;
    }
}
