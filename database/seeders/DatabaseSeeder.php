<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'email' => 'minhm@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ];
        DB::table('members')->insert($data);
    }
}
