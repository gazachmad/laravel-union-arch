<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DBResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset {--skip-migrate} {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables and re-run all migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connections = config('database.available_connections');

        foreach ($connections as $connection) {
            $this->output->writeln("Dropping $connection...");

            $this->call('db:wipe', ["--database" => $connection], $this->output);
        }

        if ($this->option('skip-migrate')) {
            return;
        }

        foreach ($connections as $connection) {
            $this->info("Migrating $connection...");

            $this->call('migrate:fresh', [
                "--database" => $connection,
                "--path" => "/database/migrations/$connection"
            ], $this->output);
        }

        if ($this->option('seed')) {
            $this->call('db:seed');
        }
    }
}
