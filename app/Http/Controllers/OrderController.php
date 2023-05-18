<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCancelRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Nomenclature;
use App\Models\Order;
use App\Models\Showcase;
use App\Services\OrderService;
use App\Services\Toast;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function __construct(
        public OrderService $orderService
    )
    {
    }

    public function index()
    {
        $showcasesCount = Showcase::count();

        $orders = Order::with(['client', 'showcase'])
            ->filter(request()?->all())
            ->orderBy('created_at', 'DESC')
            ->paginate()
            ->onEachSide(0);

        return inertia('Orders/Index', compact('orders', 'showcasesCount'));
    }

    public function create()
    {
        $nomenclatures = Nomenclature::whereHas('nomenclatureArrivals')
            ->get()
            ->transform(
                fn($m) => [
                    'id' => $m->id,
                    'text' => sprintf('%s (%s сом.)', $m->name, $m->price_for_sale),
                    'barcode' => $m->barcode,
                    'price_for_sale' => $m->price_for_sale
                ]
            );

        $showcasesCount = Showcase::count();

        $lastSelectedShowcase = $showcasesCount > 1 ? Cache::get(auth()->id() . ':last_showcase') : null;

        return inertia('Orders/Edit', compact('nomenclatures', 'showcasesCount', 'lastSelectedShowcase'));
    }

    public function store(OrderRequest $request)
    {
        $this->orderService->store($request->validated());

        return to_route('orders.index');
    }

    public function show(Order $order)
    {
        $order->load(['client', 'showcase', 'orderItems.nomenclature.unit']);

        $showcasesCount = Showcase::count();

        return inertia('Orders/Show', compact('showcasesCount', 'order'));
    }

    public function cancel(OrderCancelRequest $request, int $orderId): RedirectResponse
    {
        $this->orderService->cancel($orderId, $request->cancel_reason);

        Toast::success(sprintf('Заказ №%s успешно отменен.', $orderId));

        return back();
    }
}
