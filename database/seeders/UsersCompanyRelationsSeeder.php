<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersCompanyRelationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relations = [
            ['user_id' => 1, 'company_id' => 1],
            ['user_id' => 2, 'company_id' => 2],
        ];

        foreach ($relations as $relation) {
            User::findOrFail($relation['user_id'])->update(['company_id' => $relation['company_id']]);
        }
    }
}
