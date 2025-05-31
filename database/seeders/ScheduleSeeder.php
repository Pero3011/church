<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = ['خدمة', 'مؤتمر', 'خلوة', 'رحلة', 'قداس', 'درس كتاب', 'تسبحه'];
        $locations = ['الكنيسة', 'قاعة الاجتماعات', 'الحديقة', 'المكتبة', 'قاعة المؤتمرات'];

        for ($i = 0; $i < 20; $i++) {
            Schedule::create([
                'event' => $events[array_rand($events)],
                'date' => now()->addDays(rand(1, 365)),
                'location' => $locations[array_rand($locations)],
            ]);
        }
    }
}
