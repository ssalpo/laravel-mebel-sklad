<?php

namespace App\Services;

use App\Models\Supplier;

class SupplierService
{
    public function store(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function update(int $id, array $data): Supplier
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->update($data);

        return $supplier;
    }

    public function delete(int $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return $supplier;
    }
}
