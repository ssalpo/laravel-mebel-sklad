<?php

namespace Database\Seeders;

use App\Models\Nomenclature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NomenclatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $basePrice = random_int(10, 50);
            $priceForSale = random_int($basePrice, $basePrice + rand(1, 10));

            Nomenclature::create([
                'company_id' => 1,
                'name' => 'Nomenclature ' . $i,
                'base_price' => $basePrice,
                'price_for_sale' => $priceForSale,
                'unit_id' => 1,
            ]);
        }
    }
}
