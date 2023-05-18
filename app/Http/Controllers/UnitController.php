<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use App\Services\Toast;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct(
        public UnitService $unitService
    )
    {
    }

    public function index()
    {
        $units = Unit::orderBy('created_at', 'DESC')->get();

        return inertia('Units/Index', compact('units'));
    }

    public function create()
    {
        return inertia('Units/Edit');
    }

    public function store(UnitRequest $request)
    {
        $this->unitService->store($request->validated());

        Toast::success('Единица измерения успешно добавлена.');

        return to_route('units.index');
    }

    public function edit(Unit $unit)
    {
        return inertia('Units/Edit', compact('unit'));
    }

    public function update(int $id, UnitRequest $request)
    {
        $this->unitService->update($id, $request->validated());

        Toast::success('Данные успешно изменены.');

        return to_route('units.index');
    }

    public function destroy(int $id)
    {
        $unit = $this->unitService->delete($id);

        Toast::success('Успешно удалено.');

        return to_route('units.index');
    }
}
