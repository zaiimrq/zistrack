<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppBuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the application for production';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Building the application for production...');
        $this->call('clear');

        $this->call('optimize');
        $this->call('filament:optimize');
        $this->info('Application built successfully.');

        exec('npm run build', $output, $returnVar);
        if ($returnVar === 0) {
            $this->info('npm run build executed successfully.');
        } else {
            $this->error('npm run build failed.');
        }
    }
}
