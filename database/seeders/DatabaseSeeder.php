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
        $this->call([
            GroupMemberSeeder::class,
            GroupStatusSeeder::class,
            MemberSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
