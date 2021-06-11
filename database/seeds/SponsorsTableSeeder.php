<?php

use App\Sponsor;
use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'name' => 'Silver',
                'price' => 2.99,
                'hours' => 24
            ],
            [
                'name' => 'Gold',
                'price' => 5.99,
                'hours' => 72,
            ],
            [
                'name' => 'Platinum',
                'price' => 9.99,
                'hours' => 144,
            ]
        ];

        foreach ($sponsors as $sponsor) {
            $newSponsor = new Sponsor();
            $newSponsor->name = $sponsor['name'];
            $newSponsor->price = $sponsor['price'];
            $newSponsor->hours = $sponsor['hours'];
            $newSponsor->save();
        }
    }
}
