<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtPaymentRequest;
use App\Models\DebtPayment;
use App\Services\DebtPaymentService;
use App\Services\Toast;
use Illuminate\Http\Request;

class DebtPaymentController extends Controller
{
    public function __construct(
        public DebtPaymentService $debtPaymentService
    )
    {
    }

    public function index(int $debtId)
    {
        $payments = DebtPayment::whereDebtId($debtId)
            ->orderBy('created_at', 'DESC')
            ->paginate()
            ->onEachSide(0);

        return inertia('DebtPayments/Index', compact('payments', 'debtId'));
    }

    public function store(DebtPaymentRequest $request, int $debt)
    {
        $this->debtPaymentService->store($debt, $request->validated());

        Toast::success(sprintf('Погашение по долгу №%s успешно добавлено.', $debt));

        return back();
    }

    public function destroy(int $debtId, int $debtPaymentId)
    {
        $this->debtPaymentService->delete($debtId, $debtPaymentId);

        Toast::success(sprintf('Погашение по долгу №%s успешно удалено.', $debtId));

        return back();
    }
}
