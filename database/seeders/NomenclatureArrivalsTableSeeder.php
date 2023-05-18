<?php

namespace Database\Seeders;

use App\Models\Nomenclature;
use App\Models\NomenclatureArrival;
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
            $nomenclature = Nomenclature::withoutGlobalScopes()->findOrFail($i);

            NomenclatureArrival::create([
                'company_id' => 1,
                'nomenclature_id' => $i,
                'quantity' => random_int(15, 40),
                'base_price' => $nomenclature->base_price,
                'price_for_sale' => $nomenclature->price_for_sale
            ]);
        }
    }
}
