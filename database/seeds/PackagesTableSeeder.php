<?php

use Illuminate\Database\Seeder;
use App\Package;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'name'              => 'Nustian Package',
            'price'             => 1000,
            'description'       => '<b>One</b> of Five Competitions<br>
            <b>One</b> of Two Workshops<br>
            <b>One</b> Mushaira<br>
            <b>One</b> Concert<br>',
        ]);

        Package::create([
            'name'              => 'Non Nustian Package',
            'price'             => 1300,
            'description'       => '<b>One</b> of Five Competitions<br>
            <b>One</b> of Two Workshops<br>
            <b>One</b> Mushaira<br>
            <b>One</b> Concert<br>
            Interactive Sessions, Seminars, and Opening and Closing Ceremonies',
        ]);

        Package::create([
            'name'              => 'Professional Package',
            'price'             => 1300,
            'description'       => '<b>One</b> of Two Workshops<br>
            <b>One</b> Mushaira<br>
            <b>One</b> Concert<br>
            Interactive Sessions, Seminars, and Opening and Closing Ceremonies',
        ]);
    }
}
