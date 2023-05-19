<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use App\Services\Toast;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct(
        public SupplierService $supplierService
    )
    {
    }

    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'DESC')->get();

        return inertia('Suppliers/Index', compact('suppliers'));
    }

    public function create()
    {
        return inertia('Suppliers/Edit');
    }

    public function store(SupplierRequest $request)
    {
        $supplier = $this->supplierService->store($request->validated());

        if($request->has('modal')) {
            return response()->json([
                'id' => $supplier->id,
                'name' => $supplier->name
            ]);
        }

        Toast::success('Поставщик успешно добавлена.');

        return to_route('suppliers.index');
    }

    public function edit(Supplier $supplier)
    {
        return inertia('Suppliers/Edit', compact('supplier'));
    }

    public function update(int $id, SupplierRequest $request)
    {
        $this->supplierService->update($id, $request->validated());

        Toast::success('Данные поставщика успешно изменены.');

        return to_route('suppliers.index');
    }

    public function destroy(int $id)
    {
        $supplier = $this->supplierService->delete($id);

        Toast::success(sprintf('"%s" успешно удалена.', $supplier->name));

        return to_route('suppliers.index');
    }
}
