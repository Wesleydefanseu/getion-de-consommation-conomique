<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class IncrementField extends Command
{
    protected $signature = 'increment:field';

    protected $description = 'Augmenter la  dette a la fin du mois';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Incrémenter le champ pour chaque ligne de la table
        DB::table('forfaits')->increment('dette');

        $this->info('Field incremented successfully.');
    }
}
