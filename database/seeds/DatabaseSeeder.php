<?php

use Illuminate\Database\Seeder;
use App\University;
use App\Question;
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


        Question::truncate();
        for ($i=1; $i < 200; $i++) { 
            DB::table('questions')->insert([
                'question' => md5(random_int(1, 1000)),
                'type'     => 0,
                'level'    => random_int(1,2),
                'category' => random_int(1,4)
                ]);
            for ($j=0; $j < 4; $j++) { 
                DB::table('answers')->insert([
                'question_id' => $i,
                'answer' => md5(random_int(1, 1000)),
                'status'    => ($j == 0) ? 1:0
                ]);
            }
        }

        for ($i=0; $i < 20; $i++) { 
            DB::table('questions')->insert([
                'question' => md5(random_int(1, 1000)),
                'type'     => 1,
                'level'    => random_int(1,2),
                'category' => random_int(1,2)
                ]);
        }

        Model::reguard();
        DB::statement("SET foreign_key_checks=1");
    }
}
