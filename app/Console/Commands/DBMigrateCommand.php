<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DBMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:migrate {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connections = config('database.available_connections');

        foreach ($connections as $connection) {
            $this->info("Migrating $connection...");

            $this->call('migrate', [
                "--database" => $connection,
                "--path" => "/database/migrations/$connection"
            ], $this->output);
        }

        if ($this->option('seed')) {
            $this->call('db:seed');
        }
    }
}
