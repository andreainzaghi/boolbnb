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
             ];



        // $services = [
        //     'cucina',
        //     'aria condizionata',
        //     'asciugatrice',
        //     'Seggiolone',
        //     // 'Rilevatore di monossido di carbonio',
        //     'colazione',
        //     'ferro da stiro',
        //     'spazio di lavoro dedicato',
        //     'culla',
        //     'self check-in',
        //     'tv',
        //     'lavatrice',
        //     'wi-fi',
        //     'riscaldamento',
        //     'asciugacapelli',
        //     'allarme antincendio',
        //     'bagno privato'
        // ]; 

        $category = [
            ''
        ];

        $icon_class = [
            'fas fa-utensils',//cucina
            'fas fa-fan' ,//aria condizionata
            'fas fa-wind',// asciugatrice
            'fas fa-baby',// seggiolone
            'fas fa-coffee', // colazione
            '',// ferro da stiro??
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
        // for ($i=0; $i< count($services)-1; $i++) {

        //     $newService = new Service();
        //     $newService->name = $services[$i];
        //     $newService->icon_class = $icon_class[$i];

        //     $newService->save();
        // }
    }
}
