<?php

namespace App\Http\Controllers;

use App\Http\Requests\NomenclatureOperationRequest;
use App\Models\NomenclatureOperation;
use App\Services\NomenclatureOperationService;
use Illuminate\Http\Request;

class NomenclatureOperationController extends Controller
{
    public function __construct(
        public NomenclatureOperationService $nomenclatureOperationService
    )
    {
    }

    public function index()
    {
        $nomenclatureOperations = NomenclatureOperation::with('nomenclature')
            ->whereType(\request('type'))
            ->orderBy('created_at', 'DESC')
            ->paginate()
            ->onEachSide(0)
            ->through(fn($m) => [
                'id' => $m->id,
                'nomenclature' => ['name' => $m->nomenclature->name],
                'quantity' => $m->quantity,
                'base_price' => $m->base_price,
                'created_at_formatted' => $m->created_at_formatted,
                'comment' => $m->comment,
            ]);

        return inertia('NomenclatureOperations/Index', compact('nomenclatureOperations'));
    }

    public function create()
    {
        return inertia('NomenclatureOperations/Edit');
    }

    public function store(NomenclatureOperationRequest $request)
    {
        $this->nomenclatureOperationService->store($request->validated());

        return to_route('nomenclature-operations.index', ['type' => $request->type]);
    }

    public function edit(NomenclatureOperation $nomenclatureOperation)
    {
        return inertia('NomenclatureOperations/Edit', compact('nomenclatureOperation'));
    }

    public function update(NomenclatureOperationRequest $request, int $id)
    {
        $this->nomenclatureOperationService->update($id, $request->validated());

        return to_route('nomenclature-operations.index', ['type' => $request->type]);
    }

    public function destroy(int $id)
    {
        $nomenclatureOperation = $this->nomenclatureOperationService->destroy($id);

        return to_route('nomenclature-operations.index', ['type' => $nomenclatureOperation->type]);
    }
}
