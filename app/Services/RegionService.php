<?php

namespace App\Services;

use App\Models\Region;

class RegionService
{
    public function store(array $data): Region
    {
        return Region::create($data);
    }

    public function update(int $id, array $data): Region
    {
        $region = Region::findOrFail($id);

        $region->update($data);

        return $region;
    }

    public function delete(int $id)
    {
        $region = Region::findOrFail($id);

        $region->delete();

        return $region;
    }
}
