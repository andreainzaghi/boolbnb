<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $services = [
                [ 'name' => 'cucina',
                'icon_class' => 'fas fa-utensils' 
                ],

                [ 'name' => 'aria condizionata',
                  'icon_class' => 'fas fa-fan' 
                ],

                [ 'name' => 'asciugatrice',
                  'icon_class' => 'fas fa-wind' 
                ],
                [
                    'name' => 'seggiolone',
                    'icon_class' => 'fas fa-baby'
                ],
                [
                    'name' => 'colazione',
                    'icon_class' => 'fas fa-coffee'
                ],
                [
                    'name' => 'ferro da stiro',
                    'icon_class' => 'fas fa-tshirt'
                ],
                [
                    'name' => 'spazio di lavoro dedicato',
                    'icon_class' => 'fas fa-briefcase'
                ],
                [
                    'name' => 'culla',
                    'icon_class' => 'fas fa-baby-carriage'
                ],
                [
                    'name' => 'self check-in',
                    'icon_class' => 'fas fa-key'
                ],
                [
                    'name' => 'tv',
                    'icon_class' => 'fas fa-tv'
                ],
                [
                    'name' => 'lavatrice',
                    'icon_class' => 'fas fa-soap'
                ],
                [
                    'name' => 'wi-fi',
                    'icon_class' => 'fas fa-wifi'
                ],
                [
                    'name' => 'riscaldamento',
                    'icon_class' => 'fas fa-thermometer-full'
                ],
                [
                    'name' => 'asciugacapelli',
                    'icon_class' => 'fas fa-bell'
                ],
                [
                    'name' => 'allarme antincendio',
                    'icon_class' => 'fab fa-free-code-camp'
                ],
                [
                    'name' => 'bagno privato',
                    'icon_class' => 'fas fa-bath'
                ],
                
             ];


        $category = [
            ''
        ];

        $icon_class = [
            'fas fa-utensils',//cucina
            'fas fa-fan' ,//aria condizionata
            'fas fa-wind',// asciugatrice
            'fas fa-baby',// seggiolone
            'fas fa-coffee', // colazione
            'fas fa-tshirt',// ferro da stiro?? (ho usato una maglietta)
            'fas fa-briefcase', // spazio di lavoro dedicato
            'fas fa-baby-carriage', // culla
            'fas fa-key',// self check-in
            'fas fa-tv', // tv
            'fas fa-soap', // lavatrice
            'fas fa-wifi', //wifi
            'fas fa-thermometer-full',// riscaldamento
            'fas fa-bell', //asciugacapelli
            'fab fa-free-code-camp', //allarme antincendio
            'fas fa-bath'// bagno privato
        ];



        foreach ($services as $service) {

            $newService = new Service();

            $newService->name = $service['name'];
            $newService->icon_class = $service['icon_class'];

            $newService->save();

        }
    
    }
}
