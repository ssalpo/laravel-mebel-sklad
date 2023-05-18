<?php

namespace App\Services;

use App\Models\Unit;

class UnitService
{
    public function store(array $data): Unit
    {
        return Unit::create($data);
    }

    public function update(int $id, array $data): Unit
    {
        $unit = Unit::findOrFail($id);

        $unit->update($data);

        return $unit;
    }

    public function delete(int $id)
    {
        $unit = Unit::findOrFail($id);

        $unit->delete();

        return $unit;
    }
}
