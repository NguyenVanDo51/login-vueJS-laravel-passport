<?php

namespace App\Console\Commands;

use App\Models\Route;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class SyncRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'synchronize permission and routes';

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
        // Lay toan bo permission
        $permissions = Permission::query()->pluck('name');

        foreach (Route::query()->pluck('name') as $action) {
            $isContains = false;
            foreach ($permissions as $permission) {
                if (Str::startsWith($permission, $action)) {
                    $isContains = true;
                    break;
                }
            }

            if (!$isContains) {
                Route::query()->where('name', $action)->delete();
                $this->info("Deleted action '{$action}' in list ");
            }
        }
    }
}
