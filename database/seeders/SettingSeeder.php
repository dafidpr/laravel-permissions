<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Carbon\Carbon;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'groups' => 'General',
                'options'=> 'web_name',
                'value' => 'Laravel Permission System',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'web_url',
                'value' => 'http://127.0.0.1:8000',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'web_description',
                'value' => 'The Laravel Permission System is a system used to manage permissions in your application',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'web_keyword',
                'value' => 'Easily create permissions in your application with the Laravel Permission System',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'web_author',
                'value' => 'Web Media Solusi Digital',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'email',
                'value' => 'contact@webmediadigital.com',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'phone',
                'value' => '085642746374',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'address',
                'value' => 'Banyuwangi, Jawa Timur, Indonesia',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'facebook',
                'value' => 'https://www.facebook.com/webmedia',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'instagram',
                'value' => 'https://www.instagram.com/webmedia.id',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'General',
                'options'=> 'youtube',
                'value' => 'https://www.youtube.com/c/WebMediaSolusiDigital',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'Image',
                'options'=> 'favicon',
                'value' => 'favicon.png',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'Image',
                'options'=> 'logo',
                'value' => 'logo.png',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'groups' => 'Config',
                'options'=> 'maintenance_mode',
                'value' => 'N',
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
