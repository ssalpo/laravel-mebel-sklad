<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            'шт.',
            'кг.',
            'м.',
            'т.',
        ];

        for ($i = 1; $i <= 10; $i++) {
            foreach ($units as $unit) {
                Unit::create(['company_id' => $i, 'name' => $unit]);
            }
        }
    }
}
