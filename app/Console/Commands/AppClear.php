<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the application cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('optimize:clear');
        $this->info('Application cache cleared successfully.');
    }
}
