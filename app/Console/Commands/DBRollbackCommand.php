<?php

namespace App\Console\Commands;

use Exception;
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
    public function handle(): void
    {
        $connection = $this->argument('database');
        if (!is_string($connection)) throw new Exception("Argument 'database' must be a string");


        $this->info("Migrating $connection...");

        $this->call('migrate:rollback', [
            "--database" => $connection,
            "--path" => "/database/migrations/$connection"
        ]);
    }
}
