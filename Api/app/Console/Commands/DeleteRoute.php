<?php

namespace App\Console\Commands;

use App\Models\Route;
use Illuminate\Console\Command;

class DeleteRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:delete {route*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a route for permission function';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!$this->confirm('Are you sure ?', true)) {
            return 0;
        }

        foreach ($this->argument('route') as $route) {
            if (Route::query()->where('name', $route)->delete()) {
                $this->info("Delete action '{$route}' successfully!");
            } else {
                $this->info("Action '{$route}' not exists!");
            }
        }
    }
}
