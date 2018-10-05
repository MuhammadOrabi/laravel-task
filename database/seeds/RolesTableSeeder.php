<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales = Role::updateOrCreate(['title' => 'Sales Agent', 'slug' => 'sales-agent']);
        $permissions = Permission::where('model', 'App\Models\Proposal')->pluck('id')->toArray();
        $sales->permissions()->sync($permissions);
    }
}
