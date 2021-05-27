<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $_data = [
        [
            'username' => 'admin',
            'password' => Hash::make('123456'),
        ]
    ];
    public function run()
    {
        foreach($this->_data as $data) {
            User::create($data);
        }
    }
}
