<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Prueba1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prueba1s')->insert([
            [
                'Numero' => 25,
                'Nombre'=> 'Jose Gerardo',
                'Descripcion'=> 'Sistemas sjdhjsh'
            ]
            ]);
    }
}
