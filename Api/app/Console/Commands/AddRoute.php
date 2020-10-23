<?php

namespace App\Console\Commands;

use App\Models\Route;
use Illuminate\Console\Command;

class AddRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:add {route*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a route for permission function';

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
        foreach ($this->argument('route') as $route) {
            if (Route::query()->where('name', $route)->exists()) {
                $this->info("action '{$route}' has exists !");
            } else {
                if (Route::query()->updateOrCreate(['name' => $route])) {
                    $this->info("Add action '{$route}' to list successfully!");
                } else {
                    $this->info("Add action '{$route}' to list fail!");
                }
            }
        }
    }
}
