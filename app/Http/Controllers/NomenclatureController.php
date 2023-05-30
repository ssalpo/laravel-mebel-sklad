<?php

namespace App\Http\Controllers;

use App\Http\Requests\NomenclatureChangeBarcodeRequest;
use App\Http\Requests\NomenclatureRequest;
use App\Models\Nomenclature;
use App\Services\NomenclatureService;
use App\Services\Toast;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NomenclatureController extends Controller
{
    public function __construct(
        public NomenclatureService $nomenclatureService
    )
    {
    }

    public function index()
    {
        $nomenclatures = Nomenclature::paginate(200)->onEachSide(0);

        return inertia('Nomenclatures/Index', compact('nomenclatures'));
    }

    public function create()
    {
        return inertia('Nomenclatures/Edit');
    }

    public function store(NomenclatureRequest $request)
    {
        $this->nomenclatureService->store($request->validated());

        Toast::success('Товар успешно добавлен.');

        return to_route('nomenclatures.index');
    }

    public function edit(int $id)
    {
        $nomenclature = Nomenclature::findOrFail($id);

        return inertia('Nomenclatures/Edit', compact('nomenclature'));
    }

    public function update(NomenclatureRequest $request, int $id)
    {
        $this->nomenclatureService->update($id, $request->validated());

        Toast::success('Данные по товару успешно изменены.');

        return to_route('nomenclatures.index');
    }

    public function destroy(int $id)
    {
        $nomenclature = $this->nomenclatureService->delete($id);

        Toast::success(sprintf('"%s" успешно удалена.', $nomenclature->name));

        return to_route('nomenclatures.index');
    }

    public function changeBarcode(int $nomenclatureId, NomenclatureChangeBarcodeRequest $request): RedirectResponse
    {
        $this->nomenclatureService->changeBarcode(
            $nomenclatureId, $request->code
        );

        Toast::success('Штрихкод успешно изменен.');

        return back();
    }
}
