<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowcaseRequest;
use App\Models\Showcase;
use App\Services\ShowcaseService;
use App\Services\Toast;
use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    public function __construct(
        public ShowcaseService $showcaseService
    )
    {
    }

    public function index()
    {
        $showcases = Showcase::orderBy('created_at', 'DESC')->get();

        return inertia('Showcases/Index', compact('showcases'));
    }

    public function create()
    {
        return inertia('Showcases/Edit');
    }

    public function store(ShowcaseRequest $request)
    {
        $this->showcaseService->store($request->validated());

        Toast::success('Витрина успешно добавлена.');

        return to_route('showcases.index');
    }

    public function edit(Showcase $showcase)
    {
        return inertia('Showcases/Edit', compact('showcase'));
    }

    public function update(int $id, ShowcaseRequest $request)
    {
        $this->showcaseService->update($id, $request->validated());

        Toast::success('Данные витрины успешно изменены.');

        return to_route('showcases.index');
    }

    public function destroy(int $id)
    {
        $showcase = $this->showcaseService->delete($id);

        Toast::success(sprintf('"%s" успешно удалена.', $showcase->name));

        return to_route('showcases.index');
    }
}
