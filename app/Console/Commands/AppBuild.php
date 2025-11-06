<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class AppBuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "build";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Build the application for production";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Building the application for production...");
        $this->call("clear");

        $this->call("optimize");
        $this->call("filament:optimize");

        $result = Process::run("npm run build");

        if ($result->failed()) {
            $this->error("NPM build failed: " . $result->errorOutput());

            return $result->exitCode();
        }

        echo $result->output();

        $this->info("Application built successfully.");
    }
}
