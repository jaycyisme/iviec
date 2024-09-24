<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            'An ninh/Bảo vệ',
            'Công nghệ thông tin',
            'Kinh doanh/Bán hàng',
            'Kế toán/Tài chính',
            'Nhân sự',
            'Marketing/Quảng cáo',
            'Giáo dục/Đào tạo',
            'Y tế/Sức khỏe',
            'Xây dựng/Kiến trúc',
            'Giao thông/Vận tải',
            'Luật/Pháp lý',
            'Nông nghiệp/Lâm nghiệp',
            'Dịch vụ khách hàng',
            'Du lịch/Nhà hàng/Khách sạn',
            'Sản xuất/Công nghiệp',
            'Nghệ thuật/Thiết kế/Thời trang',
            'Khác'
        ];

        foreach ($jobs as $job) {
            Job::create([
                'name' => $job
            ]);
        }
    }
}
