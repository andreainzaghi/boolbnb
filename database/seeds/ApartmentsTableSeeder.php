<?php

use App\Apartment;
use App\User;
use App\Service;
use App\Sponsor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( Faker $faker )
    {
        
        $users = User::all();
        $services = Service::all();
        $sponsors = Sponsor::all();
        
        // Si prende la data corrente

        $appartamenti = [
            [
                'address' => 'Via Nazionale, 12',
                'city' => 'Firenze',
                'lat' => 43.777,
                'long' => 11.2519
            ],
            [
                'address' => 'Via Antonio Canova, 160',
                'city' => 'Firenze',
                'lat' => 43.77908,
                'long' => 11.1989
            ],
            [
                'address' => 'Via de\' Cerretani, 13',
                'city' => 'Firenze',
                'lat' => 43.7734,
                'long' => 11.25401
            ],
            [
                'address' => 'Via Giacomo Leopardi, 14',
                'city' => 'Firenze',
                'lat' => 43.77346,
                'long' => 11.26846
            ],
            [
                'address' => 'Viale Calatafimi, 2',
                'city' => 'Firenze',
                'lat' => 43.78184,
                'long' => 11.28668
            ],
            [
                'address' => 'Viale dei Mille, 93',
                'city' => 'Firenze',
                'lat' => 43.78368,
                'long' => 11.27341
            ],
            [
                'address' => 'Via della Madonna della Pace, 46',
                'city' => 'Firenze',
                'lat' => 43.76068,
                'long' => 11.24933
            ],
            [
                'address' => 'Via Bolognese, 233',
                'city' => 'Firenze',
                'lat' => 43.80446,
                'long' => 11.27126
            ],
            [
                'address' => 'Via Trento, 19',
                'city' => 'Firenze',
                'lat' => 43.7894,
                'long' => 11.25916
            ],
            [
                'address' => 'Via Vittorio Emanuele II, 82',
                'city' => 'Firenze',
                'lat' => 43.79056,
                'long' => 11.25467
            ],
            [
                'address' => 'Via Pola, 10',
                'city' => 'Milano',
                'lat' => 45.489007,
                'long' => 9.193201
            ],
            [
                'address' => 'Via Gaetano Serrani, 6',
                'city' => 'Milano',
                'lat' => 45.498382,
                'long' => 9.201543
            ],
            [
                'address' => 'Via Altino, 5',
                'city' => 'Milano',
                'lat' => 45.460277,
                'long' => 9.162171
            ],
            [
                'address' => 'Via Jacopo Palma, 19',
                'city' => 'Milano',
                'lat' => 45.464941,
                'long' => 9.140464
            ],
            [
                'address' => 'Via Levanto, 1',
                'city' => 'Milano',
                'lat' => 45.483396,
                'long' => 9.136438
            ],
            [
                'address' => 'Via Michelangelo Buonarroti, 47',
                'city' => 'Milano',
                'lat' => 45.472328, 
                'long' => 9.155132
            ],
            [
                'address' => 'Viale Renato Serra, 65',
                'city' => 'Milano',
                'lat' => 45.489862, 
                'long' => 9.150450
            ],
            [
                'address' => 'Via Pietro Colletta, 19',
                'city' => 'Milano',
                'lat' => 45.450361, 
                'long' => 9.207977
            ],
            [
                'address' => 'Via Canaletto, 9',
                'city' => 'Milano',
                'lat' => 45.469398, 
                'long' => 9.228507
            ],
            [
                'address' => 'Via Carlo Forlanini, 26',
                'city' => 'Milano',
                'lat' => 45.471810, 
                'long' => 9.233067
            ],
            [
                "address" => "Via Catalana, 10",
                "city" => "Roma",
                "lat" => 41.8924,
                "long" => 12.47723,
            ],
            [
                "address" => "Via della Stazione di San Pietro, 13",
                "city" => "Roma",
                "lat" => 41.89709,
                "long" => 12.45544
            ],
            [
                "address" => "Viale Aventino, 56",
                "city" => "Roma",
                "lat" => 41.88247,
                "long" => 12.48627,
            ],
            [
                "address" => "Via Cesare Balbo, 14",
                "city" => "Roma",
                "lat" => 41.89912,
                "long" => 12.49562,
            ],
            [
                "address" => "Via Calabria, 32",
                "city" => "Roma",
                "lat" => 41.9097,
                "long" => 12.49758,
            ],
            [
                "address" => "Via Borgognona, 36",
                "city" => "Roma",
                "lat" => 41.90456,
                "long" => 12.4806,
            ],
            [
                "address" => "Via Germanico, 165",
                "city" => "Roma",
                "lat" => 41.90868,
                "long" => 12.4619,
            ],
            [
                "address" => "Via Savoia, 17",
                "city" => "Roma",
                "lat" => 41.91329,
                "long" => 12.49977,
            ],
            [
                "address" => "Viale Petroriano, 18",
                "city" => "Roma",
                "lat" => 41.902,
                "long" => 12.50772,
            ],
            [
                "address" => "Via Giuseppe Siccardi, 1",
                "city" => "Roma",
                "lat" => 41.88756,
                "long" => 12.5185,
            ],
            [
                "address" => "Via Gaetano Filangieri, 12",
                "city" => "Napoli",
                "lat" => 40.83576,
                "long" => 14.24146,
            ],
            [
                "address" => "Via Partenope, 11",
                "city" => "Napoli",
                "lat" => 40.83106,
                "long" => 14.24436,
            ],
            [
                "address" => "Via Santa Maria di Costantinopoli, 103",
                "city" => "Napoli",
                "lat" => 40.85069,
                "long" => 14.2518,
            ],
            [
                "address" => "Corso Umberto I, 105",
                "city" => "Napoli",
                "lat" => 40.84583,
                "long" => 14.25905,
            ],
            [
                "address" => "Via Francesco Solimena, 61",
                "city" => "Napoli",
                "lat" => 40.84474,
                "long" => 14.2315,
            ],
            [
                "address" => "Via San Pasquale, 79",
                "city" => "Napoli",
                "lat" => 40.83517,
                "long" => 14.23614,
            ],
            [
                "address" => "Corso Vittorio Emanuele, 117",
                "city" => "Napoli",
                "lat" => 40.83651,
                "long" => 14.22517,
            ],
            [
                "address" => "Via Salvator Rosa, 336",
                "city" => "Napoli",
                "lat" => 40.853970,
                "long" => 14.248419
            ],
            [
                "address" => "Via Nuova Marina, 115",
                "city" => "Napoli",
                "lat" => 40.846182,
                "long" => 14.266335,
            ],
            [
                "address" => "Via Francesco Petrarca, 74",
                "city" => "Napoli",
                "lat" => 40.822081,
                "long" => 14.213584,
            ],
            [
                "address" => "Via Giovanni Antonio Scopoli, 53",
                "city" => "Trento",
                "lat" => 46.0756,
                "long" => 11.11829,
            ],
            [
                "address" => "Piazza Adamo d'Arogno, 12",
                "city" => "Trento",
                "lat" => 46.06664,
                "long" => 11.12111,
            ],
            [
                "address" => "Via Rodolfo Belenzani, 49",
                "city" => "Trento",
                "lat" => 46.06802,
                "long" => 11.12151,
            ],
            [
                "address" => "Via Santa Margherita, 24",
                "city" => "Trento",
                "lat" => 46.06824,
                "long" => 11.11805,
            ],
            [
                "address" => "Via Armando Diaz, 5",
                "city" => "Trento",
                "lat" => 46.069085,
                "long" => 11.122791,
            ],
            [
                "address" => "Via del Suffragio, 37",
                "city" => "Trento",
                "lat" => 46.071288,
                "long" => 11.124919,
            ],
            [
                "address" => "Via S. Pietro, 48",
                "city" => "Trento",
                "lat" => 46.069048,
                "long" => 11.124311,
            ],
            [
                "address" => "Piazza Santa Maria Maggiore, 27",
                "city" => "Trento",
                "lat" => 46.068489,
                "long" => 11.118968,
            ],
            [
                "address" => "Via Catalana, 10",
                "city" => "Trento",
                "lat" => 41.8924,
                "long" => 12.47723,
            ],
            [
                "address" => "Viale della Costituzione, 37",
                "city" => "Trento",
                "lat" => 46.060997,
                "long" => 11.115329,
            ],
            [
                "address" => "Via Privata Giovannino De Grassi, 8",
                "city" => "Milano",
                "lat" => 45.464335,
                "long" => 9.171925,
            ],
            [
                "address" => "Via Giovanni Battista Soresina, 13-3",
                "city" => "Milano",
                "lat" => 45.464916,
                "long" => 9.162110,
            ],
            [
                "address" => "Via Giuseppe Prina, 7-5",
                "city" => "Milano",
                "lat" => 45.480540,
                "long" => 9.169200,
            ],
            [
                "address" => "Via Losanna, 29-23",
                "city" => "Milano",
                "lat" => 45.486601,
                "long" => 9.164689,
            ],
            [
                "address" => "Via Giorgio Giulini, 4",
                "city" => "Milano",
                "lat" => 45.463735,
                "long" => 9.188858,
            ],
            [
                "address" => "Via Paolo Mantegazza, 4",
                "city" => "Milano",
                "lat" => 45.497904,
                "long" => 9.149728,
            ],
            [
                "address" => "Via Achille Maiocchi, 10",
                "city" => "Milano",
                "lat" => 45.4757,
                "long" => 9.21447,
            ],
            [
                "address" => "Via Errico Petrella, 7-5",
                "city" => "Milano",
                "lat" => 45.482823,
                "long" => 9.211666,
            ],
            [
                "address" => "Via Giovanni Keplero, 8-14",
                "city" => "Milano",
                "lat" => 45.493141,
                "long" => 9.197159,
            ],
        ];
     
        
        $inserted = [];
        foreach ($users as $user) {

            if( rand(0,1) ){
                for ( $i = 0; $i < rand(1,6); $i++ ) {
                    do
                        $index = rand(0, count($appartamenti) - 1);
                    while( in_array( $index, $inserted ) );

                    $apartment = new Apartment();
                    $apartment->user_id = $user->id;
                    $apartment->address = $appartamenti[$index]['address'];
                    $apartment->city = $appartamenti[$index]['city'];
                    $apartment->lat = $appartamenti[$index]['lat'];
                    $apartment->long = $appartamenti[$index]['long'];
                    $apartment->title = $faker->sentence(rand(1,3));


                   // Generazione dello slug univoco
                   do{
                        $randomNumSlug = "-".rand(0, 10000000);
                        $slugTmp = Str::slug( $apartment->title, '-' ).$randomNumSlug;
                   }
                   while( Apartment::where('slug', $slugTmp)->first() );

                   
                    $apartment->slug = $slugTmp;
                    $apartment->description = $faker->paragraph(5);
                    $apartment->rooms = rand(4, 10);
                    $apartment->bathrooms = rand(1, 2);
                    $apartment->beds = rand(1, 4);
                    $apartment->mq = rand(50, 200);
                    $apartment->image = 'images/placeholder.png';         
                    $apartment->visible = rand(0,1);

                    $inserted[] = $index;

                    
                   $apartment->save();
                    
                    //Inserimento dei servizi
                   
                    $maxServices = rand(0,count($services)-1);
                    $numServiceEntered = 0;
                    $numGen = [];
                    
                    while( $numServiceEntered <= $maxServices ){

                        $numService = rand(0, count($services)-1);

                        if( !in_array($numService, $numGen) ){
                            $numGen[] = $numService;

                            $data['services'] = $services[$numService];
                            $apartment->services()->attach($data['services']);
                            $numServiceEntered++;
                        
                        }
                    }
                }

                    //Inserimento degli sponsor
                    if($apartment->visible){
                        $currentDate = Carbon::now();
                        if(rand(0,1)){
                            $data['sponsors'] = $sponsors[rand( 0,count($sponsors)-1 )];
                            $apartment->sponsors()->attach($data['sponsors'],['expiration' => $currentDate->addHours($data['sponsors']->hours)]);
                        }
                    }
                }
            }
        }
}
