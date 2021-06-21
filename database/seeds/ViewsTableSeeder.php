<?php

use App\Apartment;
use App\User;
use App\View;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments =  Apartment::all();
        

        foreach ($apartments as $apartment) {

            for ($i=0; $i < rand(20, 100); $i++) { 
                
                $view = new View();

                $ip = $faker->ipv4();

                if( count( View::where('ip', 'like', '%'.$ip.'%')->get()) > 0 ){
                    $i--;
                }
                else{
                    $view->ip = $ip;
                    $view->apartment_id = $apartment->id;
    
                    $view->save();
                }
            }
        }
    }
}
