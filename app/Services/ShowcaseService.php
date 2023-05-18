<?php

namespace App\Services;

use App\Models\Showcase;

class ShowcaseService
{
    public function store(array $data): Showcase
    {
        return Showcase::create($data);
    }

    public function update(int $id, array $data): Showcase
    {
        $showcase = Showcase::findOrFail($id);

        $showcase->update($data);

        return $showcase;
    }

    public function delete(int $id)
    {
        $showcase = Showcase::findOrFail($id);

        $showcase->delete();

        return $showcase;
    }
}
