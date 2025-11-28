<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ClearPermissionCache extends Command
{
    protected $signature = 'permission:cache:clear';
    protected $description = 'Clear Spatie permission cache';

    public function handle()
    {
        // Clear Spatie permission cache
        app('cache')->forget('spatie.permission.cache');
        
        // Force reload from database by calling these
        Role::all();
        Permission::all();
        
        $this->info('✅ Spatie permission cache cleared successfully');
    }
}
