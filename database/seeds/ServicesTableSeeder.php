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
            'cucina',
            'aria condizionata',
            'asciugatrice',
            'colazione',
            'ferro da stiro',
            'spazio di lavoro dedicato',
            'culla',
            'self check-in',
            'tv',
            'lavatrice',
            'wi-fi',
            'riscaldamento',
            'asciugacapelli',
            'allarme antincendio',
            'bagno privato'
        ]; 



        foreach ($services as $service) {

            $newService = new Service();
            $newService->name = $service;

            $newService->save();
        }
    }
}
