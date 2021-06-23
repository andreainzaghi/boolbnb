<?php

use App\Apartment;
use App\User;
use App\View;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;


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

            for ($i=0; $i < rand(20, 40); $i++) { 
                
                $view = new View();

                $ip = $faker->ipv4();

                if( count( View::where('ip', 'like', '%'.$ip.'%')->get()) > 0 ){
                    $i--;
                }
                else{
                    $view->ip = $ip;
                    $view->apartment_id = $apartment->id;
                    $view->created_at = Carbon::now()->subDays(rand(0,360));
                    $view->updated_at = $view->created_at;
                    $view->save();
                }
            }
        }
    }
}
