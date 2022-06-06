<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'name' => 'tax',
                'ar_value' => '14',
                'en_value' => '14',
                'type' => 'number',
                'page' => 'الضريبة',
                'ar_title' => 'ضريبة القيمة المضافة',
                'en_title' => 'tax',
                'slug' => 'tax'
            ],
            [
                'name' => 'points',
                'ar_value' => '14',
                'en_value' => '14',
                'type' => 'number',
                'page' => 'النقاط',
                'ar_title' => 'قيمة النقطة',
                'en_title' => 'points',
                'slug' => 'points'
            ],
            [
                'name' => 'riyal',
                'ar_value' => '14',
                'en_value' => '14',
                'type' => 'number',
                'page' => 'النقاط',
                'ar_title' => 'قيمة الريال',
                'en_title' => 'riyal',
                'slug' => 'riyal'
            ],
            [
                'name' => 'invoice_top',
                'ar_value' => 'invoice_top',
                'en_value' => 'invoice_top',
                'type' => 'long_text',
                'page' => 'بيانات تظهر فى الفاتورة',
                'ar_title' => 'بيانات تظهر فى أعلى الفاتورة',
                'en_title' => 'invoice_top',
                'slug' => 'invoice_top'
            ],
            [
                'name' => 'invoice_bottom',
                'ar_value' => 'invoice_bottom',
                'en_value' => 'invoice_bottom',
                'type' => 'long_text',
                'page' => 'بيانات تظهر فى الفاتورة',
                'ar_title' => 'بيانات تظهر فى أسفل الفاتورة',
                'en_title' => 'invoice_bottom',
                'slug' => 'invoice_bottom'
            ],

        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
