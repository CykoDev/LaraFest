<?php

use App\EventType;
use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventType::create([
            'name'              => 'workshop',
        ]);

        EventType::create([
            'name'              => 'competition',
        ]);

        EventType::create([
            'name'              => 'interactive session',
        ]);
    }
}
