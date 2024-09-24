<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            'Giám đốc',
            'Nhân viên',
            'Trưởng phòng',
            'Phó phòng',
            'Quản lý',
            'Chuyên viên',
            'Thực tập sinh',
            'Phó giám đốc',
            'Tổng giám đốc',
            'Kỹ sư',
            'Kế toán trưởng',
            'Giám sát',
            'Chuyên gia',
            'Cố vấn',
            'Thủ quỹ',
            'Khác'
        ];

        foreach ($levels as $level) {
            Level::create([
                'name' => $level
            ]);
        }
    }
}
