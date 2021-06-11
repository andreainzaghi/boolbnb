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
        $this->call(UsersTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SponsorsTableSeeder::class);
        $this->call(ApartmentsTableSeeder::class);
        $this->call(ViewsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
    }
}
