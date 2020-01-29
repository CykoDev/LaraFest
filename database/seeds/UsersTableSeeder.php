<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::truncate();

    	User::create([
            'name'          => 'supahot',
            'role_id'       => '2',
            'email'         => 'supahot@a.aa',
            'password'      => 'aaaaaaaa',
        ]);
    }
}
