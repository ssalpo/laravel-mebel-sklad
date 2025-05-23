<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCancelRequest;
use App\Http\Requests\OrderChangeBaseInfoRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Nomenclature;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\Toast;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function __construct(
        public OrderService $orderService
    )
    {
    }

    public function index()
    {
        $orders = Order::with('region')
            ->filter(request()?->all())
            ->orderBy('created_at', 'DESC')
            ->paginate()
            ->onEachSide(0);

        return inertia('Orders/Index', compact('orders'));
    }

    public function create()
    {
        $nomenclatures = Nomenclature::all()
            ->transform(
                fn($m) => [
                    'id' => $m->id,
                    'text' => sprintf('%s (%s сом.)', $m->name, $m->price_for_sale),
                    'barcode' => $m->barcode,
                    'price_for_sale' => $m->price_for_sale
                ]
            );

        return inertia('Orders/Edit', compact('nomenclatures'));
    }

    public function store(OrderRequest $request)
    {
        $this->orderService->store($request->validated());

        return to_route('orders.index');
    }

    public function show(Order $order)
    {
        $order->load(['orderItems.nomenclature', 'region']);

        return inertia('Orders/Show', compact('order'));
    }

    public function cancel(OrderCancelRequest $request, int $orderId): RedirectResponse
    {
        $this->orderService->cancel($orderId, $request->cancel_reason);

        Toast::success(sprintf('Заказ №%s успешно отменен.', $orderId));

        return back();
    }

    public function paid(Order $order)
    {
        $order->markAsPaid();

        Toast::success('Вся сумма заказа успешно оплачена.');

        return back();
    }

    public function editBaseInfo(Order $order)
    {
        return inertia('Orders/EditBaseInfo', compact('order'));
    }

    public function changeBaseInfo(int $orderId, OrderChangeBaseInfoRequest $request)
    {
        $this->orderService->changeBaseInfo($orderId, $request->validated());

        Toast::success('Данные успешно изменены.');

        return to_route('orders.show', $orderId);
    }
}
