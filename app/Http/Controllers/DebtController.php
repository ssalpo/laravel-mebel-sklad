<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtRequest;
use App\Models\Debt;
use App\Services\DebtPaymentService;
use App\Services\DebtService;
use App\Services\Toast;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function __construct(
        public DebtService $debtService,
        public DebtPaymentService $debtPaymentService
    )
    {
    }

    public function index()
    {
        $totalDebts = $this->debtService->getTotalDebts();
        $totalPayments = $this->debtPaymentService->getTotalPayments();

        $debts = Debt::with('client', 'order')
            ->filters(request()?->all())
            ->withSum('payments', 'amount')
            ->orderBy('created_at', 'DESC')
            ->paginate()
            ->onEachSide(0);

        return inertia('Debts/Index', compact('totalDebts', 'totalPayments', 'debts'));
    }

    public function create()
    {
        return inertia('Debts/Edit');
    }

    public function store(DebtRequest $request)
    {
        $this->debtService->store($request->validated());

        Toast::success('Долг успешно добавлен.');

        return to_route('debts.index');
    }

    public function edit(Debt $debt)
    {
        return inertia('Debts/Edit', compact('debt'));
    }

    public function update(int $id, DebtRequest $request)
    {
        $this->debtService->update($id, $request->validated());

        Toast::success('Данные успешно изменены.');

        return to_route('debts.index');
    }

    public function destroy(int $id)
    {
        $debt = $this->debtService->delete($id);

        Toast::success(sprintf('Долг №%s успешно удален.', $debt->name));

        return to_route('debts.index');
    }
}
