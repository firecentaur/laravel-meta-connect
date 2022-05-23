<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::dropIfExists('questions');
        $path = 'storage/database/questions.sql';
        DB::unprepared(file_get_contents($path));
    }
}
