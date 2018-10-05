<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::updateOrCreate(['title' => 'View', 'slug' => 'view', 'model' => 'App\Models\Proposal']);
        Permission::updateOrCreate(['title' => 'Create', 'slug' => 'create', 'model' => 'App\Models\Proposal']);
        Permission::updateOrCreate(['title' => 'Update', 'slug' => 'update', 'model' => 'App\Models\Proposal']);
        Permission::updateOrCreate(['title' => 'Delete', 'slug' => 'delete', 'model' => 'App\Models\Proposal']);
        Permission::updateOrCreate(['title' => 'Restore', 'slug' => 'restore', 'model' => 'App\Models\Proposal']);
        Permission::updateOrCreate(['title' => 'Force Delete', 'slug' => 'force-delete', 'model' => 'App\Models\Proposal']);
    }
}
