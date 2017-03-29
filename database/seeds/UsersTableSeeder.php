<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('password'),
            'remember_token' => 'NfNG1U8qPnASMlqXRvMOdkhC6xWjU1h7K5fitDujuosCsZLPLcmgutNiZpl6'
        ]);
    }
}
