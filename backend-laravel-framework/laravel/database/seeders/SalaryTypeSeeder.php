<?php

namespace Database\Seeders;

use App\Models\SalaryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salaryTypes = [
          'Thỏa thuận',
          'Tối thiểu',
          'Tối đa',
          'Chi tiết lương',
          'Không hưởng lương'
        ];

        foreach($salaryTypes as $salaryType) {
            SalaryType::create([
                'name' => $salaryType,
            ]);
        }
    }
}
