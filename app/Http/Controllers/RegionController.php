<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use App\Models\Region;
use App\Services\RegionService;
use App\Services\Toast;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function __construct(
        public RegionService $regionService
    )
    {
    }

    public function index()
    {
        $regions = Region::orderBy('created_at', 'DESC')->get();

        return inertia('Regions/Index', compact('regions'));
    }

    public function create()
    {
        return inertia('Regions/Edit');
    }

    public function store(RegionRequest $request)
    {
        $region = $this->regionService->store($request->validated());

        if($request->has('modal')) {
            return response()->json([
                'id' => $region->id,
                'name' => $region->name
            ]);
        }

        Toast::success('Новый регион успешно добавлен.');

        return to_route('regions.index');
    }

    public function edit(Region $region)
    {
        return inertia('Regions/Edit', compact('region'));
    }

    public function update(int $id, RegionRequest $request)
    {
        $this->regionService->update($id, $request->validated());

        Toast::success('Данные региона успешно изменены.');

        return to_route('regions.index');
    }

    public function destroy(int $id)
    {
        $region = $this->regionService->delete($id);

        Toast::success(sprintf('Регион "%s" успешно удален.', $region->name));

        return to_route('regions.index');
    }
}
