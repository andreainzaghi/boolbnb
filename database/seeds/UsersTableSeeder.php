<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i=0; $i < 10; $i++) { 
            
            $user = new User();

            // Setto i valori dell'utente
            $user->name = $faker->firstName($gender = 'male'|'female');
            $user->last_name = $faker->lastName($gender = 'male'|'female');
            $user->email = $faker->email();
            $user->password = Hash::make($faker->password());
            $user->birthday = $faker->date();

            $user->save();
        }

        $this->addAdminUser();
    }

    /*
    * *************** DA ELIMINARE PRIMA DI PRESENTARE IL PROGETTO FINALE ****************
    *
    * Funzione che aggiunge un utente con queste credenzia:
    *   
    * name: Franco
    * last_name: Francone
    * email: franco@gmail.com
    * birthday: 1970-1-1
    * password: ciao1234
    * 
    */

    public function addAdminUser(){

        $user = new User();

        $user->name = "Franco";
        $user->last_name = "Francone";
        $user->birthday = "1970-1-1";
        $user->email = "franco@gmail.com";
        $user->password = Hash::make("ciao1234");

        $user->save();
    }
}
