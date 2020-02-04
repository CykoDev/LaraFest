<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'supahot',
            'role_id'           => Role::whereName('admin')->firstOrFail()->id,
            'email'             => 'supahot@a.aa',
            'email_verified_at' => now(),
            'password'          => 'aaaaaaaa',
        ]);
    }
}
