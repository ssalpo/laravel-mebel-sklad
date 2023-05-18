<?php

namespace Database\Seeders;

use App\Models\Nomenclature;
use App\Models\NomenclatureArrival;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NomenclatureArrivalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $nomenclature = Nomenclature::findOrFail($i);

            NomenclatureArrival::create([
                'nomenclature_id' => $i,
                'supplier_id' => random_int(1, 10),
                'quantity' => random_int(15, 40),
                'base_price' => $nomenclature->base_price,
                'price_for_sale' => $nomenclature->price_for_sale
            ]);
        }
    }
}
