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
            'weight' => 5,
        ]);
        $criteria1->subCriterias()->createMany([
            ['criteria_id' => $criteria1->id, 'name' => '<30', 'weight' => 1, 'min_value' => 0, 'max_value' => 29.99],
            ['criteria_id' => $criteria1->id, 'name' => '30-70', 'weight' => 2, 'min_value' => 30, 'max_value' => 70],
            ['criteria_id' => $criteria1->id, 'name' => '>70', 'weight' => 7, 'min_value' => 70.01, 'max_value' => 100],
        ]);

        $criteria2 = Criteria::create([
            'name' => 'Jurusan',
            'weight' => 1,
        ]);
        $criteria2->subCriterias()->createMany([
            ['criteria_id' => $criteria2->id, 'name' => 'Administrasi Perkantoran, Pengembangan Masyarakat Islam, etc', 'weight' => 1],
            ['criteria_id' => $criteria2->id, 'name' => 'Manajemen Informatika', 'weight' => 4],
            ['criteria_id' => $criteria2->id, 'name' => 'Administrasi Publik, Pembangunan Ekonomi dan Pemberdayaan Masyarakat', 'weight' => 5],
        ]);

        $criteria3 = Criteria::create([
            'name' => 'Tingkat Pendidikan',
            'weight' => 2,
        ]);
        $criteria3->subCriterias()->createMany([
            ['criteria_id' => $criteria3->id, 'name' => 'SMA/SMK', 'weight' => 1],
            ['criteria_id' => $criteria3->id, 'name' => 'D3, D4', 'weight' => 4],
            ['criteria_id' => $criteria3->id, 'name' => 'S1', 'weight' => 7],
        ]);
    }
}
