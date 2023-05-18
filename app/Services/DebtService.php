<?php

namespace App\Services;

use App\Models\Debt;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DebtService
{
    public function store(array $data): Debt
    {
        return Debt::create($data);
    }

    public function update(int $id, array $data): Debt
    {
        $debt = Debt::withSum('payments', 'amount')->findOrFail($id);

        if ($data['amount'] < $debt->payments_sum_amount) {
            throw ValidationException::withMessages([
                'amount' => sprintf(
                    'Сумма долга не может быть ниже %s сом., так как у вас уже имеется погашение на данную сумму.',
                    $debt->payments_sum_amount
                )
            ]);
        }

        if ($data['amount'] > $debt->payments_sum_amount) {
            $data['is_paid'] = false;
        }

        $debt->update($data);

        return $debt;
    }

    public function delete(int $id)
    {
        $debt = Debt::findOrFail($id);

        DB::transaction(function () use ($debt) {
            $debt->payments()->delete();

            $debt->delete();
        });

        return $debt;
    }

    public function getTotalDebts()
    {
        return Debt::sum('amount');
    }
}
