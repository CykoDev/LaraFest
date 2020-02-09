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
            'price'             => 69696969,
            'description'       => 'a package. literally a package.',
        ]);

        Package::create([
            'name'              => 'Non Nustian Package',
            'price'             => 69696969,
            'description'       => 'a package. literally a package.',
        ]);

        Package::create([
            'name'              => 'Professional Package',
            'price'             => 69696969,
            'description'       => 'a package. literally a package.',
        ]);
    }
}
