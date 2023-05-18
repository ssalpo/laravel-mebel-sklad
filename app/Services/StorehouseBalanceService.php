<?php

namespace App\Services;

use App\Models\NomenclatureArrival;
use App\Models\NomenclatureOperation;
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

        $nomenclatureOperations = NomenclatureOperation::select(
            'type',
            'nomenclature_id',
            DB::raw('SUM(quantity) as quantity')
        )
            ->groupBy('type')
            ->groupBy('nomenclature_id')
            ->get();

        return NomenclatureArrival::select(
            'nomenclature_id',
            DB::raw('n.name AS nomenclature_name'),
            DB::raw('SUM(quantity) AS quantity'),
        )->join('nomenclatures as n', 'n.id', '=', 'nomenclature_arrivals.nomenclature_id')
            ->groupBy('nomenclature_id')
            ->get()
            ->transform(function ($m) use ($orderItems, $nomenclatureOperations) {
                $orderItem = $orderItems->where('nomenclature_id', $m->nomenclature_id)->first();
                $nomenclatureWithdraw = $nomenclatureOperations->where('nomenclature_id', $m->nomenclature_id)
                    ->where('type', NomenclatureOperation::OPERATION_TYPE_WITHDRAW)->first();

                $nomenclatureRefund = $nomenclatureOperations->where('nomenclature_id', $m->nomenclature_id)
                    ->where('type', NomenclatureOperation::OPERATION_TYPE_REFUND)->first();

                $subtractQuantity = ($orderItem?->quantity ?? 0) + ($nomenclatureWithdraw?->quantity ?? 0);

                return [
                    'id' => $m->nomenclature_id,
                    'nomenclature_name' => $m->nomenclature_name,
                    'quantity' => ($m->quantity + ($nomenclatureRefund?->quantity ?? 0)) - $subtractQuantity,
                ];
            });
    }
}
