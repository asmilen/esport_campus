<?php

use Illuminate\Database\Seeder;
use App\University;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement("SET foreign_key_checks=0");
        Model::unguard();

        University::truncate();

        DB::table('university')->insert([
            'name' => 'Đại học ngoại thương Hà Nội',
            'short_name' => 'FTU',
            'desc' => '',
            'image' => '',
            'status' => 1,
        ]);
        DB::table('university')->insert([
            'name' => 'Đại học Kinh tế Quốc dân',
            'short_name' => 'NEU',
            'desc' => '',
            'image' => '',
            'status' => 1,
        ]);
        DB::table('university')->insert([
            'name' => 'Đại học bách khoa',
            'short_name' => 'FU',
            'desc' => '',
            'image' => '',
            'status' => 1,
        ]);
        DB::table('university')->insert([
            'name' => 'Đại học ngân hàng',
            'short_name' => 'STFU',
            'desc' => '',
            'image' => '',
            'status' => 1,
        ]);
        Model::reguard();
        DB::statement("SET foreign_key_checks=1");
    }
}
