<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();


        DB::table('users')->insert([
            0 =>
                [
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('admin'),
                    'remember_token' => NULL,
                    'api_token' => Str::random(60),
                    'last_login_at' => NULL,
                    'last_login_ip' => NULL,
                    'created_at' => Carbon::create(now())->toDateTimeString(),
                    'updated_at' => Carbon::create(now())->toDateTimeString(),
                ]
        ]);
        $this->command->info('User Table Import done!');

        $this->command->info('You may login using admin@dux.com');

    }
}
