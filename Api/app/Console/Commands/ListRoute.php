<?php

namespace App\Console\Commands;

use App\Models\Route;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class ListRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a list routes for permission function';

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
        foreach (Route::query()->orderBy('name')->pluck('name') as $permission) {
            $this->info($permission);
        }
    }
}
