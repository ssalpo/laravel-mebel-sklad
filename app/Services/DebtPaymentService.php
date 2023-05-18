<?php

namespace App\Services;

use App\Models\Debt;
use App\Models\DebtPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DebtPaymentService
{
    public function store(int $debtId, array $data): DebtPayment
    {
        $debt = Debt::with('payments')
            ->notPaid()
            ->findOrFail($debtId);

        $alreadyPaidAmount = $debt->payments->sum('amount');
        $endPaidAmount = $alreadyPaidAmount + $data['amount'];

        if ($endPaidAmount > $debt->amount) {
            throw ValidationException::withMessages([
                'amount' => sprintf('Максимальное значение суммы должно быть равно %s сом.', $debt->amount - $alreadyPaidAmount)
            ]);
        }

        return DB::transaction(static function () use ($debt, $data, $endPaidAmount) {
            $payment = $debt->payments()->create($data);

            if ($debt->amount === $endPaidAmount) {
                $debt->markAsPaid();
            }

            return $payment;
        });
    }

    public function delete(int $debtId, int $debtPaymentId): DebtPayment
    {
        $payment = DebtPayment::whereDebtId($debtId)->findOrFail($debtPaymentId);

        $payment->delete();

        return $payment;
    }

    public function getTotalPayments()
    {
        return DebtPayment::whereHas('debt')->sum('amount');
    }
}
