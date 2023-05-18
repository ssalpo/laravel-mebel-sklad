<?php

namespace App\Services;

use App\Models\NomenclatureArrival;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class StorehouseBalanceService
{
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
            DB::raw('SUM(quantity) AS quantity'),
        )->join('nomenclatures as n', 'n.id', '=', 'nomenclature_arrivals.nomenclature_id')
            ->groupBy('nomenclature_id')
            ->get()
            ->transform(function ($m) use ($orderItems) {
                $orderItem = $orderItems->where('nomenclature_id', $m->nomenclature_id)->first();

                return [
                    'id' => $m->nomenclature_id,
                    'nomenclature_name' => $m->nomenclature_name,
                    'quantity' => $m->quantity - ($orderItem?->quantity ?? 0),
                ];
            });
    }
}
