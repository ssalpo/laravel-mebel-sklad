<?php

namespace App\Services;

use App\Models\Nomenclature;
use App\Models\Order;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection as ModelCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function store(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $nomenclatures = Nomenclature::whereIn(
                'id',
                Arr::pluck($data['orderItems'], 'nomenclature_id')
            )->get();

            $totals = $this->calculateTotals($data, $nomenclatures);

            if (Supplier::count() <= 1) {
                $data['supplier_id'] = Supplier::latest()->first()?->id;
            }

            $order = Order::create(array_merge(
                [
                    'status' => Order::STATUS_SOLD,
                    'profit' => $totals['profit'],
                    'amount' => $totals['amount'],
                ],
                Arr::except($data, 'orderItems')
            ));

            foreach ($data['orderItems'] as $item) {
                $nomenclature = $nomenclatures->where('id', $item['nomenclature_id'])->first();
                $item['price'] = $nomenclature->price;
                $item['base_price'] = $nomenclature->base_price;

                $order->orderItems()->create($item);
            }

            return $order;
        });
    }

    public function calculateTotals(array $data, ModelCollection $nomenclatures): array
    {
        $amount = 0;
        $profit = 0;

        foreach ($data['orderItems'] as $item) {
            $nomenclature = $nomenclatures->where('id', $item['nomenclature_id'])->first();

            $priceForSale = $item['price_for_sale'];

            if (!$nomenclature) {
                continue;
            }

            $amount += $priceForSale * (int)$item['quantity'];
            $profit += !$nomenclature->base_price ? 0 : ($priceForSale - $nomenclature->base_price) * (int)$item['quantity'];
        }

        return compact('amount', 'profit');
    }

    public function cancel(int $orderId, string $cancelReason): Order
    {
        $order = Order::sold()->findOrFail($orderId);

        $order->update([
            'cancel_reason' => $cancelReason,
            'status' => Order::STATUS_CANCELED
        ]);

        return $order;
    }
}
