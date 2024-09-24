<?php

namespace Database\Seeders;

use App\Models\WorkingForm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkingFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workingforms = [
            'Toán thời gian',
            'Bán thời gian',
            'Làm việc từ xa',
            'Thời vụ',
            'Freelance',
            'Hybrid',
            'Khác'
        ];

        foreach($workingforms as $workingform) {
            WorkingForm::create([
                'name' => $workingform
            ]);
        }
    }
}
