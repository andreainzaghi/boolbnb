<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\Apartment;
use Carbon\Carbon;
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
            for ($i=0; $i < rand(0,20); $i++) { 
                    $newMessage = new Message;
                    $newMessage->apartment_id = $apartment->id;
                    $newMessage->email = $faker->email();
                    $newMessage->content = $faker->text(rand(20,100));

                    $newMessage->created_at = Carbon::now()->subDays(rand(0,360));
                    $newMessage->updated_at = $newMessage->created_at;
                    $newMessage->save();
            }
         
        }
    }
}