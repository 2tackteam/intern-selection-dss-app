<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteria1 = Criteria::create([
            'name' => 'Nilai / GPA',
            'weight' => 1,
        ]);
        $criteria1->subCriterias()->createMany([
            ['criteria_id' => $criteria1->id, 'name' => '<30', 'weight' => 1],
            ['criteria_id' => $criteria1->id, 'name' => '30-70', 'weight' => 2],
            ['criteria_id' => $criteria1->id, 'name' => '>70', 'weight' => 7],
        ]);

        $criteria2 = Criteria::create([
            'name' => 'Jurusan',
            'weight' => 2,
        ]);
        $criteria2->subCriterias()->createMany([
            ['criteria_id' => $criteria2->id, 'name' => 'A - E', 'weight' => 1],
            ['criteria_id' => $criteria2->id, 'name' => 'F - I', 'weight' => 3],
            ['criteria_id' => $criteria2->id, 'name' => 'J - Z', 'weight' => 5],
        ]);

        $criteria3 = Criteria::create([
            'name' => 'Tingkat Pendidikan',
            'weight' => 5,
        ]);
        $criteria3->subCriterias()->createMany([
            ['criteria_id' => $criteria3->id, 'name' => 'SMA/SMK', 'weight' => 1],
            ['criteria_id' => $criteria3->id, 'name' => 'D3, D4', 'weight' => 4],
            ['criteria_id' => $criteria3->id, 'name' => 'S1', 'weight' => 7],
        ]);
    }
}
