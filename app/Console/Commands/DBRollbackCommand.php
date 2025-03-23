<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DBRollbackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:rollback {database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback the last database migration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = $this->argument('database');

        $this->info("Migrating $connection...");

        $this->call('migrate:rollback', [
            "--database" => $connection,
            "--path" => "/database/migrations/$connection"
        ], $this->output);
    }
}
