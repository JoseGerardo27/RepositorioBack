<?php

namespace App\Console\Commands;

use App\Mail\NewUser;
use App\Models\Colaborador;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Envio:correo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'envia correo';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $Nuevo = Colaborador::where('id', 1)->first();
        Mail::to('adan.gonzalez@gpocsi.mx')->send(new NewUser($Nuevo));
    }
}
