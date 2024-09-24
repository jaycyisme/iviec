<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Đang hoạt động',
            'Hoàn thành',
            'Tạm dừng',
            'Đang tìm việc',
            'Chưa tìm việc',
            'Không xác định',
            'Ứng tuyển',
            'Phỏng vấn',
            'Đạt',
            'Loại',
        ];

        foreach($statuses as $status) {
            Status::create([
                'name' => $status
            ]);
        }
    }
}
