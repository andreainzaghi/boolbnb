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
        $seeders = [UsersTableSeeder::class, 
                    ServicesTableSeeder::class, 
                    SponsorsTableSeeder::class, 
                    ApartmentsTableSeeder::class, 
                    ViewsTableSeeder::class, 
                    MessagesTableSeeder::class];

        $this->call($seeders);       
    }
}
