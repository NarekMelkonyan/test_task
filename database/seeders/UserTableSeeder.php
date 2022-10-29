<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
