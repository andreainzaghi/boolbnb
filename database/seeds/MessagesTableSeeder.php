<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\Apartment;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( Faker $faker )
    {
        
        $apartments = Apartment::all();
        
        foreach ($apartments as $apartment) {
            if( rand(0,1) ){
                $newMessage = new Message;
                $newMessage->apartment_id = $apartment->id;
                $newMessage->email = $faker->email();
                $newMessage->content = $faker->text(rand(20,100));
                $newMessage->save();
            }
        }
    }
}