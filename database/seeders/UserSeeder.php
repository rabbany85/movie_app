<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->title = "Mr";
        $user->name = "Golam";
        $user->last_name = "Rabbany";
        $user->date_of_birth = '1980-06-18';
        $user->password = Hash::make('secRet@007');
        $user->email = "rabbany85@gmail.com";
        $user->phone = "+447990002240";
        $user->role = "Admin";
        $user->save();

        User::factory()->times(100)->create();
    }
}
