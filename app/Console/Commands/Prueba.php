<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        return Command::SUCCESS;
    }
}
