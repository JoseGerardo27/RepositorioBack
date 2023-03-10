<?php

namespace App\Console\Commands;

use App\Models\Colaborador;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Prueba extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
        protected $signature = 'prueba1:prueba';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'envia correos cada 1 min';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Colaborador::where('departamento', 15)->update(['sesion'=>5]);
    }
}

